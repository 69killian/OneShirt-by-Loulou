<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
   
    public function getImage($id)
    {
        $image = ProductImage::findOrFail($id);
        $imageData = $image->image; // Contenu BLOB de l'image
        $mimeType = $image->mime_type; // Récupérer le type MIME stocké (par exemple "image/jpeg")
    
        // Retourner l'image avec le type MIME approprié
        return response($imageData, 200)->header('Content-Type', $mimeType);
    }
    

}
