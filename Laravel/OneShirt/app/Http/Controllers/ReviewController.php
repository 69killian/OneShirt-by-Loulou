<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{

    // Récupération de tous les avis
    public function index()
    {
        $reviews = Review::all(); 
        return response()->json($reviews); // Retourne les données en JSON
    }



    // Vérification de connexion
    public function check()
{
    $user = Auth::user();
    // données de l'utilisateur à récupérer
    $userData = [
        'id' => $user->id,
        'last_name' => mb_convert_encoding($user->last_name, 'UTF-8', 'auto'),
        'email' => mb_convert_encoding($user->email, 'UTF-8', 'auto'),

    ];

    return response()->json([
        'authenticated' => Auth::check(),
        'user' => $userData
    ], 200, [], JSON_UNESCAPED_UNICODE);
}

    

    // Création d'un nouvel avis 
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'user_id' => 'required|integer|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = new Review();
        $review->product_id = $request->product_id;
        $review->user_id = Auth::id();
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return response()->json(['message' => 'Avis soumis avec succès'], 201);
    }

    // Suppression d'un avis 
    public function deleteReview($id)
{
    try {
        $review = Review::findOrFail($id);
        $review->delete();
        Log::info('Produit supprimé avec succès:', ['id' => $id]);
        return response()->json(['message' => 'Avis supprimé avec succès']);
    } catch (\Exception $e) {
        Log::error('Erreur lors de la suppression de l\'avis:', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Erreur lors de la suppression de l\'avis'], 500);
    }
}


}
