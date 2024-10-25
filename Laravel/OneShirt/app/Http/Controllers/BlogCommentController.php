<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\BlogArticle; // Corrigez ceci
use Illuminate\Http\Request;
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
    


    
}
