<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle; // Assurez-vous que ce modèle est correctement importé
use Illuminate\Http\JsonResponse;

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
}
