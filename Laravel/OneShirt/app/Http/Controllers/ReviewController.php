<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all(); // Récupère tous les avis
        return response()->json($reviews); // Retourne les données en JSON
    }
}

