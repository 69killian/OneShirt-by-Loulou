<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductSize;
use Illuminate\Database\QueryException;

class ProductSizeController extends Controller
{
    public function index($id)
{
    try {
        // Supposons que ProductSize a une relation avec Product
        $productSizes = ProductSize::where('product_id', $id)->get(); // Récupérer toutes les tailles pour le produit spécifié
        return response()->json($productSizes);
    } catch (QueryException $e) {
        return response()->json(['error' => 'Erreur lors de la récupération des tailles: ' . $e->getMessage()], 500);
    }
}


}
