<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


// Route pour récupérer les Produits
Route::get('/api/products', 
    [ProductController::class, 'index']
);



Route::get('/', function () {
    return view('welcome'); // Vue pour la page d'accueil
});

Route::get('/{any}', function () {
    return view('welcome'); // Vue principale pour toutes les autres routes
})->where('any', '.*');









