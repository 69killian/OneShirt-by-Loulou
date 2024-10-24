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



    // Fonction de récupération des Figurines
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
    



    // Fonction de récupération des Vêtements
    public function getVetements()
    {
        try {
            // Récupération des produits de type "t-shirt" et "autre" avec les images associées
            $products = Product::with(['images', 'reviews', 'sizes'])
                ->whereIn('type', ['tshirt', 'autre']) // Utilisation de whereIn pour spécifier les types
                ->get();
    
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
            return response()->json(['error' => 'Erreur de récupération des vêtements : ' . $e->getMessage()], 500);
        }
    }
    
    public function show($id)
    {
        try {
            // Récupération du produit avec ses images, avis et tailles associées
            $product = Product::with(['images', 'reviews', 'sizes',])->find($id);
            
            // Vérifier si le produit existe
            if (!$product) {
                return response()->json(['message' => 'Produit non trouvé'], 404);
            }
            
            // Log des données récupérées pour déboguer
            Log::info('Produit récupéré:', ['product' => $product]);
            
            // Encode les images en base64 et prépare les autres champs
            if ($product->images) {
                $product->images->map(function ($image) {
                    // Vérifier si l'image est définie
                    if ($image->image) {
                        // Encodage de l'image en base64
                        $image->image_base64 = 'data:image/png;base64,' . base64_encode($image->image); 
                    } else {
                        $image->image_base64 = null; 
                    }
                    unset($image->image); 
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
            $product->size = $product->sizes ? $product->sizes->pluck('name')->toArray() : [];
    
            // Retourner les détails du produit, y compris les images encodées
            return response()->json($product);
        } catch (\Exception $e) {
            // Gestion des erreurs
            Log::error('Erreur lors de la récupération du produit:', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Erreur lors de la récupération du produit: ' . $e->getMessage()
            ], 500);
        }
    }
    
    


    


}
