<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;


// Route pour déconnexion utilisateur
Route::post('/api/logout', [LoginController::class, 'logout']);


// Route pour connexion utilisateur
Route::post('/api/login', [LoginController::class, 'login']);


// Route pour créer un utilisateur
Route::post('/register', [RegisterController::class, 'store']);


// Route Pour envoi de Mail via PHPMailer et Laravel
Route::post('/api/send-email', [MailController::class, 'sendEmail']);


// Route pour récupérer les Informations Utilisateur
Route::get('/reviews', [ReviewController::class, 'index']);


// Route pour récupérer les Informations Utilisateur
Route::get('/api/users', [UserController::class, 'getAllUsers']);


// Route pour récupération des Articles de Blog
Route::get('/api/blog-articles', [BlogArticleController::class, 'index']);

// Route pour récupérer les Produits
Route::get('/api/products', 
    [ProductController::class, 'index']
);

// Route pour récupéraion des Figurines
Route::get('/api/figurines', [ProductController::class, 'getFigurines']);

// Route pour récupéraion des Vêtements
Route::get('/api/vetements', [ProductController::class, 'getVetements']);





Route::get('/', function () {
    return view('welcome'); // Vue pour la page d'accueil
});

Route::get('/{any}', function () {
    return view('welcome'); // Vue principale pour toutes les autres routes
})->where('any', '.*');









