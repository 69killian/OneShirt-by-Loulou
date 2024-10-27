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
        // Trouver l'article par son slug
        $article = BlogArticle::where('slug', $slug)->firstOrFail();
        
        // Renvoyer les commentaires de l'article
        return response()->json($article->comments); // Cela devrait fonctionner maintenant
    }
    
    public function store(Request $request, $slug)
{
    // Vérifiez si l'utilisateur est connecté
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
    $comment->user_id = Auth::id(); // Récupération de l'ID de l'utilisateur connecté
    $comment->article_id = $article->id; // ID de l'article associé
    $comment->comment = $request->comment; // Contenu du commentaire
    $comment->article_slug = $slug; // Ajout du slug dans la colonne article_slug
    $comment->save(); // Sauvegarde du commentaire dans la base de données

    return response()->json($comment, 201); // Réponse avec le commentaire créé
}

    
}
