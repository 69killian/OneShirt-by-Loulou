<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        try {
            // Récupération des produits avec leurs images, avis et tailles associées
            $products = Product::with(['images', 'reviews', 'sizes'])->get();

            // Encode les images en base64 et prépare les autres champs
            $products->map(function ($product) {
                // Encodage des images
                if ($product->images) {
                    $product->images->map(function ($image) {
                        // Détection du type MIME
                        $mimeType = $this->getMimeType($image->image);
                        $image->image_base64 = $mimeType 
                            ? 'data:' . $mimeType . ';base64,' . base64_encode($image->image)
                            : base64_encode($image->image);
                        unset($image->image); // Optionnel : supprime le champ binaire original
                        return $image;
                    });
                }

                // Calcule la moyenne des avis
                if ($product->reviews) {
                    $averageRating = $product->reviews->avg('rating');
                    $product->average_reviews = $averageRating ? round($averageRating, 1) : null;
                } else {
                    $product->average_reviews = null;
                }

                // Extrait les tailles sous forme de tableau
                if ($product->sizes) {
                    $product->size = $product->sizes->pluck('name')->toArray();
                } else {
                    $product->size = [];
                }

                return $product;
            });

            Log::info('Affichage de la vue produits.index');
            return response()->json($products);
        } catch (\Exception $e) {
            // Gestion des erreurs en cas de problèmes
            Log::error('Erreur lors de la récupération des produits:', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Erreur lors de la récupération des produits: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Détecte le type MIME de l'image.
     *
     * @param string $binaryData
     * @return string|null
     */
    private function getMimeType($binaryData)
    {
        // Utilise une méthode pour détecter le type MIME
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        return $finfo->buffer($binaryData);
    }

    public function getFigurines()
    {
        try {
            // Récupération les produits de type "figurine" avec les images associées
            $products = Product::with(['images', 'reviews', 'sizes'])->where('type', 'figurine')->get();
    
            // Mappe les données pour renvoyer une réponse formatée
            $response = $products->map(function ($product) {
                // Encodage des images
                $images = $product->images->map(function ($image) {
                    // Détection du type MIME
                    $mimeType = $this->getMimeType($image->image);
                    // Encodage en base64
                    $image->image_base64 = $mimeType 
                        ? 'data:' . $mimeType . ';base64,' . base64_encode($image->image)
                        : base64_encode($image->image);
                    unset($image->image); // Optionnel : supprime le champ binaire original
                    return $image;
                });
    
                // Calcule la moyenne des avis
                $averageRating = $product->reviews ? $product->reviews->avg('rating') : null;
                $product->average_reviews = $averageRating ? round($averageRating, 1) : null;
    
                // Extrait les tailles sous forme d'un tableau
                $size = $product->sizes ? $product->sizes->pluck('name')->toArray() : [];
    
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'images' => $images, // Utilisation de l'array d'images formaté
                    'average_reviews' => $product->average_reviews,
                    'size' => $size,
                ];
            });
    
            return response()->json($response);
        } catch (\Exception $e) {
            // Gère les erreurs et renvoie un message d'erreur
            return response()->json(['error' => 'Erreur de récupération des figurines : ' . $e->getMessage()], 500);
        }
    }
    

}
