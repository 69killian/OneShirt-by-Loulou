<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function check()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return response()->json([
                'authenticated' => true,
                'user' => [
                    'id' => $user->id,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                ]
            ], 200);
        }

        return response()->json(['authenticated' => false], 200);
    }

    public function getCartItems()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $cart = Cart::where('user_id', $userId)->first();
    
            if ($cart) {
                return response()->json([
                    'items' => $cart->items()->with('product')->get()
                ]);
            }
    
            return response()->json(['items' => []]);
        }
    
        return response()->json(['error' => 'User not authenticated'], 403);
    }


    public function getImagesByProductId($id)
{
    try {
        // Récupérer les images du produit
        $images = ProductImage::where('product_id', $id)->get();

        // Vérifiez si des images ont été récupérées
        if ($images->isEmpty()) {
            Log::info('Aucune image trouvée pour le produit ID: ' . $id);
            return response()->json(['error' => 'Aucune image trouvée'], 404);
        }

        // Convertir chaque image en Base64
        $images->map(function ($image) {
            // Vérifiez si l'image est stockée sous forme de BLOB
            if (!empty($image->image)) {
                // Log des données de l'image avant l'encodage
                Log::info('Données d\'image récupérées pour l\'ID d\'image: ' . $image->id, [
                    'image_data' => substr($image->image, 0, 50) . '...', // Affiche seulement les premiers 50 caractères
                    'product_id' => $image->product_id,
                ]);

                // Vérifiez l'encodage de l'image
                if (!mb_check_encoding($image->image, 'UTF-8')) {
                    // Essayer de corriger l'encodage si ce n'est pas UTF-8
                    $image->image = mb_convert_encoding($image->image, 'UTF-8', 'ISO-8859-1'); // ou un autre encodage approprié
                    Log::info('Encodage corrigé pour l\'ID d\'image: ' . $image->id);
                }

                // Convertir l'image en Base64
                try {
                    $mimeType = $this->getMimeType($image->image); // Supposons que vous avez cette méthode
                    $image->image_base64 = $mimeType 
                        ? 'data:' . $mimeType . ';base64,' . base64_encode($image->image)
                        : base64_encode($image->image);
                } catch (\Exception $e) {
                    Log::error('Erreur lors de l\'encodage de l\'image pour l\'ID d\'image: ' . $image->id, [
                        'error_message' => $e->getMessage(),
                    ]);
                    $image->image_base64 = null;
                }
            } else {
                // Gérer le cas où l'image est vide
                Log::warning('Image vide pour l\'ID d\'image: ' . $image->id);
                $image->image_base64 = null;
            }
            return $image; // Assurez-vous de retourner l'image modifiée
        });

        return response()->json($images);
    } catch (\Exception $e) {
        Log::error('Erreur lors de la récupération des images pour le produit ID: ' . $id, [
            'error_message' => $e->getMessage(),
        ]);
        return response()->json(['error' => 'Erreur lors de la récupération des images: ' . $e->getMessage()], 500);
    }
}

    
    
}
