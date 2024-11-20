<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\BlogArticle; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BlogCommentController extends Controller
{
    public function getCommentsByArticleSlug($slug)
    {
        // Récupère l'article par son slug
        $article = BlogArticle::where('slug', $slug)->firstOrFail();
        
        // Renvoie les commentaires de l'article
        return response()->json($article->comments); 
    }
    
    public function store(Request $request, $slug)
{
    // Vérifie si l'utilisateur est connecté
    if (!Auth::check()) {
        return response()->json(['message' => 'Veuillez vous connecter pour laisser un commentaire.'], 401);
    }

    // Validation des données
    $request->validate([
        'comment' => 'required|string|max:255',
    ]);

    // Récupération de l'article par son slug
    $article = BlogArticle::where('slug', $slug)->firstOrFail();

    // Insertion du commentaire
    $comment = new BlogComment();
    $comment->user_id = Auth::id(); 
    $comment->article_id = $article->id; 
    $comment->comment = $request->comment; 
    $comment->article_slug = $slug; 
    $comment->save(); 

    return response()->json($comment, 201); // Réponse avec le commentaire créé
}

    
}
