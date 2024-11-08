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
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductImageController;

// Route pour ajouter un nouveau produit au panier de la page des produits
Route::post('/api/cart/add/{productId}', [CartController::class, 'addCartItem']);


// Route pour mettre à jour les quantités du panier
Route::put('/api/cart/items/{productId}', [CartController::class, 'updateCartItemQuantity']);


// Route pour supprimer les cartitem selectionnés du panier d'un utilisateur
Route::delete('/api/cart/items/{productId}', [CartController::class, 'removeCartItem']);


// Route pour récupérer les CartItem dans le panier
Route::get('/api/cart', [CartController::class, 'getCartItems']);


Route::get('/api/check', [CartController::class, 'check']);


// Route pour vérifier la connection utilisateur
Route::get('/api/auth/check', [ReviewController::class, 'check']);


// Route pour obtenir les tailles des produits
Route::get('/api/tailles/{id}', [ProductSizeController::class, 'index']);


// Update du profil utilisateur
Route::post('/api/update-profile', [UserController::class, 'updateProfile']);


// Route pour Récupération du profil connecté
Route::get('/api/profile', [LoginController::class, 'getProfile']);


// Route pour déconnexion utilisateur
Route::post('/api/logout', [LoginController::class, 'logout']);


// Route pour connexion utilisateur
Route::post('/api/login', [LoginController::class, 'login']);


// Route pour créer un utilisateur
Route::post('/api/register', [RegisterController::class, 'store']);


// Route Pour envoi de Mail via PHPMailer et Laravel
Route::post('/api/send-email', [MailController::class, 'sendEmail']);


// Route pour supprimer un avis
Route::delete('/api/reviews/delete/{id}', [ReviewController::class, 'deleteReview']);

// Route pour récupérer les avis 
Route::get('/reviews', [ReviewController::class, 'index']);


// Route pour créer un avis et l'insérer
Route::post('/api/reviews/insert', [ReviewController::class, 'store']);








// Route pour créer un nouvel Utilisateur
Route::post('/api/create/users', [UserController::class, 'createUser']);


// Route pour modifier un Utilisateur
Route::post('/api/update/users/{id}', [UserController::class, 'updateUser']);


// Route pour supprimer un Utilisateur
Route::delete('/api/delete/users/{id}', [UserController::class, 'deleteUser']);


// Route pour récupérer les Informations Utilisateur
Route::get('/api/users', [UserController::class, 'getAllUsers']);


// Route pour récupérer les infos d'un utilisateur par son identifiant
Route::get('/api/users/{id}', [UserController::class, 'getUserById']);







// Route pour récupérer les commentaires par articles
Route::get('api/article/{slug}/comments', [BlogCommentController::class, 'getCommentsByArticleSlug']);


// Route pour insérer des commentaires par articles et utilisateurs
Route::post('api/article/{slug}/comments', [BlogCommentController::class, 'store']);


// Route pour récupération des Articles de Blog
Route::get('/api/blog-articles', [BlogArticleController::class, 'index']);


// Route pour récupération des page d'articles
Route::get('api/blog-articles/{slug}', [BlogArticleController::class, 'show']);


// Route pour créer un article dashboard
Route::post('/api/blog-articles/create', [BlogArticleController::class, 'store']);


// Route pour modifier un article dashboard
Route::put('/api/blog-articles/update/{id}', [BlogArticleController::class, 'update']);


// Route pour supprimer les articles du dashboard
Route::delete('/api/blog-articles/delete/{id}', [BlogArticleController::class, 'destroy']);





// Route pour créer une nouvelle Image de produit
Route::post('/api/create/product-image', [ProductImageController::class, 'store']);

// Route pour mettre à jour une image d'un produit
Route::put('/api/upadte/product-image/{productId}', [ProductImageController::class, 'update']);

// Route pour supprimer l'image d'un Produit (fait pour être supprimé avec le produit)
Route::delete('/api/delete/product-image/{id}', [ProductImageController::class, 'delete']);




// Route pour créer un nouveau produit
Route::post('/api/create/products', [ProductController::class, 'store']);

//Route pour mettre à jour un produit existant
Route::put('/api/update/products/{productId}', [ProductController::class, 'update']);

// Route pour supprimer un produit existant
Route::delete('/api/delete/products/{id}', [ProductController::class, 'destroy']);

// Route pour récupération des pages de produits
Route::get('/api/produit/{id}', [ProductController::class, 'show']);


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









