<?php

namespace App\Http\Controllers;

   use Illuminate\Http\Request;
   use App\Models\Order;
   use App\Models\Cart;
   use App\Models\CartItem;
   use App\Models\OrderItem;
   use Illuminate\Support\Facades\Auth;
   use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{
 

    public function storeOrderAfterPayment(Request $request)
    {
        // Vérification de l'utilisateur authentifié
        if (!Auth::check()) {
            return response()->json(['error' => 'User not authenticated'], 403);
        }
        
        $user = Auth::user();

        // Récupération des informations du panier de l'utilisateur
        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        // Récupération des articles du panier avec les informations sur les produits
        $cartItems = $cart->items()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        // Calcule le montant total de la commande
        $totalAmount = 0;
        foreach ($cartItems as $cartItem) {
            $totalAmount += $cartItem->quantity * $cartItem->product->price;
        }

        // Crée une nouvelle commande
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $totalAmount,
            'payment_status' => 'paid', // Statut du paiement
            'payment_method' => 'stripe', // Méthode de paiement
            'shipping_address' => $user->address, // Adresse de livraison
            'billing_address' => $user->address, // Adresse de facturation (facultatif)
        ]);

        // Ajoute les articles de la commande avec le prix unitaire
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'unit_price' => $cartItem->product->price,
                'total_price' => $cartItem->quantity * $cartItem->product->price,
            ]);
        }

        // Supprime les articles du panier après la commande
        $cart->items()->delete();

        return response()->json(['message' => 'Order created successfully'], 201);
    }



    public function index(Request $request)
    {
        try {
            // Ajouter un log pour vérifier l'initialisation de la méthode
            Log::debug('Récupération des commandes - Début');

            // Récupérer les commandes depuis la base de données
            $orders = Order::all();

            // Vérifier l'encodage des données avant de les retourner
            $ordersJson = json_encode($orders);

            // Si json_encode échoue, il peut y avoir un problème d'encodage
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Erreur d\'encodage JSON: ' . json_last_error_msg());
            }

            // Retourner les commandes avec un encodage correct
            return response()->json($orders);

        } catch (\Exception $e) {
            // Ajouter un log pour l'exception
            Log::error('Erreur lors de la récupération des commandes : ' . $e->getMessage());

            // Retourner un message d'erreur avec le statut 500
            return response()->json(['error' => 'Erreur lors de la récupération des commandes.'], 500);
        }
    }


}