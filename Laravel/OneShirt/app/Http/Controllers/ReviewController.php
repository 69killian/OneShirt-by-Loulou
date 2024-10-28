<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all(); // Récupère tous les avis
        return response()->json($reviews); // Retourne les données en JSON
    }



    public function check()
{
    $user = Auth::user();

    // Normaliser les attributs
    $userData = [
        'id' => $user->id,
        'last_name' => mb_convert_encoding($user->last_name, 'UTF-8', 'auto'),
        'email' => mb_convert_encoding($user->email, 'UTF-8', 'auto'),
        // Ajoutez d'autres attributs que vous souhaitez renvoyer
    ];

    return response()->json([
        'authenticated' => Auth::check(),
        'user' => $userData
    ], 200, [], JSON_UNESCAPED_UNICODE);
}

    


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'user_id' => 'required|integer|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $review = new Review();
        $review->product_id = $request->product_id;
        $review->user_id = Auth::id();
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return response()->json(['message' => 'Avis soumis avec succès'], 201);
    }


}

