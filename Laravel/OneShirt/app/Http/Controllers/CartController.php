<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
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
                    'last_name' => $user->last_name,
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

    
}
