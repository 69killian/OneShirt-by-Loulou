<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductImageController extends Controller
{
   
    public function getProductImage($id)
    {
        $image = ProductImage::findOrFail($id);
        $imageData = $image->image; // Contenu BLOB de l'image
        $mimeType = $image->mime_type; // Récupère le type MIME stocké (par exemple "image/jpeg")
    
        // Retourne l'image avec le type MIME approprié
        return response($imageData, 200)->header('Content-Type', $mimeType);
    }
    
/**
     * Ajoute une nouvelle image pour un produit.
     */
    public function store(Request $request, $productId)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation de l'image
        ]);

        $product = Product::findOrFail($productId);

        // Enregistre l'image dans le stockage public
        $imagePath = $request->file('image')->store('product_images', 'public');

        // Crée un enregistrement dans la table product_images
        $productImage = new ProductImage();
        $productImage->product_id = $product->id;
        $productImage->image = $imagePath; // Chemin du fichier
        $productImage->mime_type = $request->file('image')->getMimeType();
        $productImage->save();

        return response()->json(['message' => 'Image ajoutée avec succès!', 'image' => $productImage], 201);
    }




    /**
     * Met à jour l'image d'un produit.
     */
    public function update(Request $request, $imageId)
    {
        // Recherche de l'image produit associée
        $productImage = ProductImage::findOrFail($imageId);
    
        // Validation des données envoyées
        $validatedData = $request->validate([
            'image' => 'required|image|max:2048', // Validation de l'image
        ]);
    
        // Gestion du téléchargement de l'image
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageData = file_get_contents($image->getRealPath()); // Lire l'image dans une variable binaire
                $productImage->image = $imageData; // Stocker l'image dans la base de données (en binaire)
            }
        } catch (\Exception $e) {
            Log::error("Image processing failed: " . $e->getMessage());
            return response()->json(['error' => 'Image processing failed'], 500);
        }
    
        // Sauvegarde des modifications
        try {
            $productImage->save(); // Enregistrer les modifications dans la base de données
        } catch (\Exception $e) {
            Log::error("Database save error: " . $e->getMessage());
            return response()->json(['error' => 'Failed to update product image'], 500);
        }
    
        // Retourne uniquement les informations nécessaires (pas l'image binaire brute)
        return response()->json([
            'message' => 'Image mise à jour avec succès!',
            'image_id' => $productImage->id, // Retourne l'ID de l'image mise à jour
        ], 200);
    }
    
    





    /**
     * Supprime l'image d'un produit.
     */
    public function delete($imageId)
    {
        $productImage = ProductImage::findOrFail($imageId);

        // Supprime l'image du stockage
        if (Storage::disk('public')->exists($productImage->image)) {
            Storage::disk('public')->delete($productImage->image);
        }

        // Supprime l'enregistrement de la base de données
        $productImage->delete();

        return response()->json(['message' => 'Image supprimée avec succès!'], 200);
    }
}
