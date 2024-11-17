<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle; // Assurez-vous que ce modèle est correctement importé
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
    



    // Créer un nouvel article de blog
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog_articles,slug',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',  // Validation de l'image
            'author_id' => 'required|exists:users,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        // Création de l'article
        $article = new BlogArticle();
        $article->title = $request->input('title');
        $article->slug = $request->input('slug');
        $article->content = $request->input('content');
        $article->author_id = $request->input('author_id');
    
        // Gestion du téléchargement de l'image
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageData = file_get_contents($image->getRealPath()); // Lire l'image dans une variable binaire
                $article->image = $imageData; // Stocker l'image dans la base de données (en binaire)
            }
        } catch (\Exception $e) {
            Log::error("Image processing failed: " . $e->getMessage());
            return response()->json(['error' => 'Image processing failed'], 500);
        }
    
        // Sauvegarde de l'article
        try {
            $article->save(); // Enregistrer l'article dans la base de données
        } catch (\Exception $e) {
            Log::error("Database save error: " . $e->getMessage());
            return response()->json(['error' => 'Failed to create article'], 500);
        }
    
        return response()->json($article, 201);
    }
    





    
    public function update(Request $request, $id)
    {
        $article = BlogArticle::findOrFail($id);
    
        // Validation des données envoyées
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',  // Validation de l'image
        ]);
    
        // Mise à jour des données textuelles
        $article->title = $validatedData['title'];
        $article->slug = $validatedData['slug'];
        $article->content = $validatedData['content'];
    
        // Gestion du téléchargement de l'image
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageData = file_get_contents($image->getRealPath()); // Lire l'image dans une variable binaire
                $article->image = $imageData; // Stocker l'image dans la base de données (en binaire)
            }
        } catch (\Exception $e) {
            Log::error("Image processing failed: " . $e->getMessage());
            return response()->json(['error' => 'Image processing failed'], 500);
        }
    
        // Sauvegarde des modifications
        try {
            $article->save(); // Enregistrer l'article dans la base de données
        } catch (\Exception $e) {
            Log::error("Database save error: " . $e->getMessage());
            return response()->json(['error' => 'Failed to update article'], 500);
        }
    
        return response()->json($article, 200);
    }
    

    
    




    

    // Supprime un article de blog
    public function destroy($id)
    {
        $article = BlogArticle::findOrFail($id);
        $article->delete();
        return response()->json(['message' => 'Article supprimé avec succès'], 200);
    }





















     // Créer un nouvel article de blog par l'identifiant d'une personne connectée
     public function storebyId(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'title' => 'required|string|max:255',
             'slug' => 'required|string|unique:blog_articles,slug',
             'content' => 'required',
             'image' => 'nullable|image|max:2048',  // Validation de l'image
             'author_id' => 'required|exists:users,id',
         ]);
     
         if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()], 400);
         }
     
         // Création de l'article
         $article = new BlogArticle();
         $article->title = $request->input('title');
         $article->slug = $request->input('slug');
         $article->content = $request->input('content');
         $article->author_id = $request->input('author_id');
     
        // Gestion du téléchargement de l'image
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $image->store('blog_images', 'public'); 
                $article->image = $path; 
            }
        } catch (\Exception $e) {
            Log::error("Image processing failed: " . $e->getMessage());
            return response()->json(['error' => 'Image processing failed'], 500);
        }

         // Sauvegarde de l'article
         try {
             $article->save(); // Enregistrer l'article dans la base de données
         } catch (\Exception $e) {
             Log::error("Database save error: " . $e->getMessage());
             return response()->json(['error' => 'Failed to create article'], 500);
         }
     
         return response()->json($article, 201);
     }


}