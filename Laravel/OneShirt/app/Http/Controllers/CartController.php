<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function check()
    {
        if (Auth::check()) {
            $user = Auth::user();
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

    public function getCartItems()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $cart = Cart::where('user_id', $userId)->first();
    
            if ($cart) {
                return response()->json([
                    'items' => $cart->items()->with('product')->get()
                ]);
            }
    
            return response()->json(['items' => []]);
        }
    
        return response()->json(['error' => 'User not authenticated'], 403);
    }


    public function removeCartItem($productId)
{
    if (Auth::check()) {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

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


    
public function addCartItem(Request $request, $productId)
{
    if (Auth::check()) {
        $userId = Auth::id();

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
