<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Vérifie si l'utilisateur est connecté
    public function check()
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Renvoie les données de l'utilisateur connecté dans la console
            return response()->json([
                'authenticated' => true,
                'user' => [
                    'id' => $user->id,
                    'first_name' => $user->last_name,
                    'email' => $user->email,
                ]
            ], 200);
        }

        return response()->json(['authenticated' => false], 200);
    }


    // Récupération des Produit assigné à un panier
    public function getCartItems()
    {
        // récupère l'identifiant de l'utilisateur connecté et son panier
        if (Auth::check()) {
            $userId = Auth::id();
            $cart = Cart::where('user_id', $userId)->first();
            // Puis son panier
            if ($cart) {
                return response()->json([
                    'items' => $cart->items()->with('product')->get()
                ]);
            }
    
            return response()->json(['items' => []]);
        }
    
        return response()->json(['error' => 'User not authenticated'], 403);
    }


    // Suppression des Produits du Panier
    public function removeCartItem($productId)
{
    // Même méthode de récupération utilisateur
    if (Auth::check()) {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        // Vérification et suppression avec message
        if ($cart) {
            $item = $cart->items()->where('product_id', $productId)->first();
            if ($item) {
                $item->delete();
                return response()->json(['success' => 'Article supprimé du panier'], 200);
            } else {
                return response()->json(['error' => 'Article non trouvé dans le panier'], 404);
            }
        }

        return response()->json(['error' => 'Panier introuvable'], 404);
    }

    return response()->json(['error' => 'Utilisateur non authentifié'], 403);
}


    // Mise à jour des quantités des produits dans le panier
    public function updateCartItemQuantity(Request $request, $productId)
{
    if (Auth::check()) {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if ($cart) {
            $item = $cart->items()->where('product_id', $productId)->first();
            if ($item) {
                // Met à jour la quantité avec la valeur envoyée dans la requête
                $item->quantity = $request->input('quantity');
                $item->save();
                return response()->json(['success' => 'Quantité mise à jour'], 200);
            } else {
                return response()->json(['error' => 'Article non trouvé dans le panier'], 404);
            }
        }
        return response()->json(['error' => 'Panier introuvable'], 404);
    }

    return response()->json(['error' => 'Utilisateur non authentifié'], 403);
}


    // Ajout d'un produit dans le panier
    public function addCartItem(Request $request, $productId)
{
    if (Auth::check()) {
        $userId = Auth::id();

        // Création du Panier si non existant
        $cart = Cart::firstOrCreate(
            ['user_id' => $userId],
            ['created_at' => now(), 'updated_at' => now()]
        );

        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
            return response()->json(['success' => 'Quantité augmentée pour cet article dans le panier.']);
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => 1
            ]);
            return response()->json(['success' => 'Produit ajouté au panier avec succès.']);
        }
    } else {
        return response()->json(['error' => 'Vous devez être connecté pour ajouter des articles au panier.'], 403);
    }
}


    
}
