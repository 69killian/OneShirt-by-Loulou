<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle; // Assurez-vous que ce modèle est correctement importé
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BlogArticleController extends Controller
{
    public function index(): JsonResponse
    {
        $articles = BlogArticle::all()->map(function($article) {
            // Encodez l'image si elle existe
            if ($article->image) {
                $article->image = base64_encode($article->image);
            }
            return $article;
        });

        return response()->json($articles, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function show($slug): JsonResponse
    {
        $article = BlogArticle::where('slug', $slug)->first();
    
        if (!$article) {
            return response()->json(['message' => 'Article non trouvé'], 404);
        }
    
        // Encodez l'image si elle existe
        if ($article->image) {
            // Utilisez stream_get_contents uniquement si l'image est un flux
            // Vérifiez si l'image est un BLOB
            if (is_resource($article->image)) {
                $article->image = base64_encode(stream_get_contents($article->image));
            } else {
                $article->image = base64_encode($article->image); // si c'est déjà une chaîne
            }
        }
    
        // Assurez-vous que le contenu est bien encodé
        $article->title = mb_convert_encoding($article->title, 'UTF-8', 'auto');
        $article->content = mb_convert_encoding($article->content, 'UTF-8', 'auto');
    
        return response()->json($article, 200, [], JSON_UNESCAPED_UNICODE);
    }
    



}