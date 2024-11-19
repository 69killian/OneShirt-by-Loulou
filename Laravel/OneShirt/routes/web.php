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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PromotionController;


use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Promotion;




Route::post('/api/stripe/webhook', function (Request $request) {
    Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    $payload = $request->getContent();
    $sigHeader = $request->header('Stripe-Signature');
    $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

    try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sigHeader, $endpointSecret
        );
    } catch (\UnexpectedValueException $e) {
        return response()->json(['error' => 'Invalid payload'], 400);
    } catch (\Stripe\Exception\SignatureVerificationException $e) {
        return response()->json(['error' => 'Invalid signature'], 400);
    }

    if ($event->type === 'payment_intent.succeeded') {
        $paymentIntent = $event->data->object;

        // Récupération des informations nécessaires (par exemple, ID utilisateur ou panier)
        $metadata = $paymentIntent->metadata;

        $cart = Cart::where('user_id', $metadata->user_id)->first();
        if ($cart) {
            $cartItems = $cart->items()->with('product')->get();

            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;
                $product->stock_quantity -= $cartItem->quantity;
                $product->save();
            }

            // Vide le panier
            $cart->items()->delete();
        }
    }

    return response()->json(['status' => 'success'], 200);
});


// Route pour paiement Stripe et récupération des données
Route::post('/api/payment-intent', function (Request $request) {
    // Vérification de l'utilisateur authentifié
    if (!Auth::check()) {
        return response()->json(['error' => 'User not authenticated'], 403);
    }

    // Récupération de l'utilisateur authentifié
    $user = Auth::user();

    // Vérifie si l'utilisateur a les informations nécessaires
    if (!$user->first_name || !$user->last_name || !$user->email || !$user->phone_number || !$user->address) {
        return response()->json(['error' => 'Incomplete user information'], 400);
    }

    // Récupération des informations du panier de l'utilisateur
    $cart = Cart::where('user_id', $user->id)->first();
    if (!$cart) {
        return response()->json(['error' => 'Cart not found'], 404);
    }

    // Récupération des articles du panier avec les informations sur les produits
    $cartItems = $cart->items()->with('product')->get();
    if ($cartItems->isEmpty()) {
        return response()->json(['error' => 'Cart is empty'], 400);
    }

    // Calcule le montant total de la commande basé sur les prix des produits
    $totalAmount = 0;
    $productDetails = [];

    foreach ($cartItems as $cartItem) {
        // Récupère le produit et sa promotion associée
        $product = $cartItem->product;
        $promotion = $product->promotion_id ? Promotion::find($product->promotion_id) : null;

        // Calcule le prix après réduction si une promotion est appliquée
        $productPrice = $product->price;
        if ($promotion) {
            $discountPercentage = $promotion->discount_percentage;
            $discountAmount = $productPrice * ($discountPercentage / 100);
            $productPrice = $productPrice - $discountAmount;
        }

        // Ajoute le prix du produit après réduction et autres détails dans le tableau
        $totalAmount += $cartItem->quantity * $productPrice;

        $productDetails[] = [
            'name' => $product->name,
            'price' => $productPrice,  // Le prix après réduction
            'promotion_id' => $product->promotion_id,
            'quantity' => $cartItem->quantity,
            'discount_percentage' => $promotion ? $promotion->discount_percentage : 0,
            'original_price' => $cartItem->product->price,  // Le prix original avant réduction
        ];
    }

    // Converti en centimes (Stripe attend le montant en centimes pour éviter les problèmes de précision avec les décimales)
    $totalAmountInCents = $totalAmount * 100;

    // Crée le PaymentIntent avec le montant total
    Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    $paymentIntent = PaymentIntent::create([
        'amount' => $totalAmountInCents,  // Montant en centimes
        'currency' => $request->currency,
        'payment_method_types' => ['card'],
    ]);

    // Retourne le client_secret, le montant total en euros, les détails des produits, et les informations utilisateur
    return response()->json([
        'client_secret' => $paymentIntent->client_secret,
        'total_amount' => $totalAmount,  // Retourne le montant total en euros
        'products' => $productDetails,  // Détails des produits
        'user' => [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'address' => $user->address,  
            'postal_address' => $user->address, 
        ]
    ]);
});





// Route pour récupération des Promotions
Route::get('/promotions', [PromotionController::class, 'index']);


// Route pour création des Promotions
Route::post('/promotions/store', [PromotionController::class, 'store']);


// Route pour mettre à jour les Promotions
Route::put('/promotions/update/{promotion}', [PromotionController::class, 'update']);


// Route pour supprimer une opération de Promotion
Route::delete('/promotions/delete/{promotion}', [PromotionController::class, 'destroy']);


// Route pour récupérer les commandes sur le Dashboard Admin
Route::get('/api/orders', [OrderController::class, 'index']);


// Route pour récupérer les produits des commandes sur le DashboardAdmin
Route::get('/api/orderItems', [OrderController::class, 'index']);


// Route pour validation de la commande, si le payement est réussi
Route::post('/api/process-order', [OrderController::class, 'storeOrderAfterPayment']);


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
Route::post('/api/login/dashboard', [LoginController::class, 'AdminLogin']);


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


// Route pour créer un article sur le site
Route::post('/api/blog-articles/create/user', [BlogArticleController::class, 'storeById']);


// Route pour récupération des page d'articles
Route::get('api/blog-articles/{slug}', [BlogArticleController::class, 'show']);


// Route pour créer un article dashboard
Route::post('/api/blog-articles/create', [BlogArticleController::class, 'store']);


// Route pour modifier un article dashboard
Route::post('/api/blog-articles/update/{id}', [BlogArticleController::class, 'update']);


// Route pour supprimer les articles du dashboard
Route::delete('/api/blog-articles/delete/{id}', [BlogArticleController::class, 'destroy']);


// Route pour créer un article dashboard
Route::post('/api/blog-articles/create/{userId}', [BlogArticleController::class, 'storeById']);


// Route pour créer une nouvelle Image de produit
Route::post('/api/create/product-image/{productId}', [ProductImageController::class, 'store']);

// Route pour mettre à jour une image d'un produit
Route::post('/api/update/product-image/{productId}', [ProductImageController::class, 'update']);

// Route pour supprimer l'image d'un Produit (fait pour être supprimé avec le produit)
Route::delete('/api/delete/product-image/{id}', [ProductImageController::class, 'delete']);




// Route pour créer un nouveau produit
Route::post('/api/create/products', [ProductController::class, 'store']);

//Route pour mettre à jour un produit existant
Route::post('/api/update/products/{productId}', [ProductController::class, 'update']);

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









