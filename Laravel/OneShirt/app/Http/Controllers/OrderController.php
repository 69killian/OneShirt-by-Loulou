<?php

namespace App\Http\Controllers;

   use Illuminate\Http\Request;
   use App\Models\Order;
   use App\Models\Cart;
   use App\Models\CartItem;
   use App\Models\OrderItem;
   use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
 

    public function storeOrder(Request $request)
    {
        // Vérification de l'utilisateur authentifié
        if (!Auth::check()) {
            return response()->json(['error' => 'User not authenticated'], 403);
        }
    
        $user = Auth::user();
    
        // Récupérer les informations du panier de l'utilisateur
        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }
    
        // Récupérer les articles du panier avec les informations sur les produits
        $cartItems = $cart->items()->with('product')->get();
        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }
    
        // Calculer le montant total de la commande
        $totalAmount = 0;
        foreach ($cartItems as $cartItem) {
            // Assurez-vous que le produit est chargé pour accéder à son prix
            $totalAmount += $cartItem->quantity * $cartItem->product->price;
        }
    
        // Créer une nouvelle commande
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $totalAmount,
            'payment_status' => 'paid', // Statut du paiement
            'payment_method' => 'stripe', // Méthode de paiement
            'shipping_address' => $user->address, // Adresse de livraison
            'billing_address' => $user->address, // Adresse de facturation (facultatif)
        ]);
    
        // Ajouter les articles de la commande avec le prix unitaire provenant de la table 'products'
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'unit_price' => $cartItem->product->price, // Récupération du prix unitaire du produit
                'total_price' => $cartItem->quantity * $cartItem->product->price, // Total pour l'article
            ]);
        }
    
        // Supprimer les articles du panier après la commande
        $cart->items()->delete();
    
        return response()->json(['message' => 'Order created successfully'], 201);
    }
    

}
