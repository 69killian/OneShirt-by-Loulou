<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductImageController extends Controller
{
   
    // Récupère les images des produits
    public function getProductImage($id)
    {
        $image = ProductImage::findOrFail($id);
        $imageData = $image->image; // Contenu BLOB de l'image
        $mimeType = $image->mime_type; // Récupère le type MIME stocké (par exemple "image/jpeg")
    
        // Retourne l'image avec le type MIME approprié
        return response($imageData, 200)->header('Content-Type', $mimeType);
    }
    
     // Ajoute une nouvelle image pour un produit.
    public function store(Request $request, $productId)
{
    $validator = Validator::make($request->all(), [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $product = Product::findOrFail($productId);

    $productImage = new ProductImage();
    $productImage->product_id = $product->id;

    // Traitement de l'image en tant que donnée binaire
    try {
        $image = $request->file('image');
        $productImage->image = file_get_contents($image->getRealPath()); // Stockage de l'image en binaire dans la base de données
    } catch (\Exception $e) {
        Log::error("Image processing failed: " . $e->getMessage());
        return response()->json(['error' => 'Image processing failed'], 500);
    }

    // Sauvegarde DE l'image dans la base de données
    try {
        $productImage->save();
    } catch (\Exception $e) {
        Log::error("Database save error: " . $e->getMessage());
        return response()->json(['error' => 'Failed to save product image'], 500);
    }

    return response()->json(['message' => 'Image ajoutée avec succès!', 'image' => $productImage], 201);
}






    // Mise à jour de l'image d'un produit.
    public function update(Request $request, $productId)
    {
        // Recherche de l'image produit associée à ce produit (par product_id)
        $productImage = ProductImage::where('product_id', $productId)->first();
    
        if (!$productImage) {
            return response()->json(['error' => 'Image not found for this product'], 404);
        }
    
        // Validation des données envoyées
        $validatedData = $request->validate([
            'image' => 'required|image|max:2048', // Validation de l'image
        ]);
    
        // Gestion du téléchargement de l'image
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageData = file_get_contents($image->getRealPath()); // Lecture de l'image dans une variable binaire
                $productImage->image = $imageData; // Stocke l'image dans la base de données (en binaire)
            }
        } catch (\Exception $e) {
            Log::error("Image processing failed: " . $e->getMessage());
            return response()->json(['error' => 'Image processing failed'], 500);
        }
    
        // Sauvegarde des modifications
        try {
            $productImage->save(); // Enregistre les modifications dans la base de données
        } catch (\Exception $e) {
            Log::error("Database save error: " . $e->getMessage());
            return response()->json(['error' => 'Failed to update product image'], 500);
        }
    
        // Retourne uniquement les informations nécessaires
        return response()->json([
            'message' => 'Image mise à jour avec succès!',
            'image_id' => $productImage->id, // Retourne l'ID de l'image mise à jour
        ], 200);
    }
    
    
    





    // Suppression de l'image d'un produit.
    public function delete($imageId)
    {
        // Recherche de l'image dans la base de données en utilisant l'imageId
        $productImage = ProductImage::find($imageId);
    
        if ($productImage) {
            // Supprime l'image du stockage
            if (Storage::disk('public')->exists($productImage->image)) {
                Storage::disk('public')->delete($productImage->image);
            }
    
            // Supprime l'enregistrement de la base de données
            $productImage->delete();
    
            return response()->json(['message' => 'Image supprimée avec succès!'], 200);
        } else {
            return response()->json(['message' => 'Image non trouvée'], 404);
        }
    }
    
}
