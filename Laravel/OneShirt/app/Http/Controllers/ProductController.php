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
            // Récupérer les produits avec leurs images, avis et tailles associés
            $products = Product::with(['images', 'reviews', 'sizes'])->get();

            // Encoder les images en base64 et préparer les autres champs
            $products->map(function ($product) {
                // Encodage des images
                if ($product->images) {
                    $product->images->map(function ($image) {
                        // Détecter le type MIME
                        $mimeType = $this->getMimeType($image->image);
                        $image->image_base64 = $mimeType 
                            ? 'data:' . $mimeType . ';base64,' . base64_encode($image->image)
                            : base64_encode($image->image);
                        unset($image->image); // Optionnel : supprimer le champ binaire original
                        return $image;
                    });
                }

                // Calculer la moyenne des avis
                if ($product->reviews) {
                    $averageRating = $product->reviews->avg('rating');
                    $product->average_reviews = $averageRating ? round($averageRating, 1) : null;
                } else {
                    $product->average_reviews = null;
                }

                // Extraire les tailles sous forme de tableau
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
            // Gestion des erreurs en cas de problème
            Log::error('Erreur lors de la récupération des produits:', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Erreur lors de la récupération des produits: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Détecter le type MIME de l'image.
     *
     * @param string $binaryData
     * @return string|null
     */
    private function getMimeType($binaryData)
    {
        // Utiliser une méthode fiable pour détecter le type MIME
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        return $finfo->buffer($binaryData);
    }
}
