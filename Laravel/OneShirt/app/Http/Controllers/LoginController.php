<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
   // Méthode pour se connecter
   public function login(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:8',
    ]);

    Log::info('Données de connexion:', $request->all());

    $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    // Trouve l'utilisateur par nom d'utilisateur ou email
    $user = User::where($fieldType, $request->name)->first();

    if ($user) {
        Auth::login($user);
        
        // Construit manuellement la réponse avec les données nécessaires
        return response()->json([
            'message' => 'Connexion réussie',
            'user' => [
                'id' => $user->id,
                'first_name' => $user->name,
                'email' => $user->email,
            ]
        ], 200);
    }

    // Retourne une réponse d'erreur si l'authentification échoue
    Log::error('Échec de la connexion', ['name' => $request->name]);
    return response()->json(['message' => 'Les informations de connexion sont incorrectes.'], 401);
}









    // Connexion Administrateur 
    public function AdminLogin(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:8',
    ]);

    Log::info('Données de connexion:', $request->all());

    $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    // Trouve l'utilisateur par nom d'utilisateur ou email
    $user = User::where($fieldType, $request->name)->first();

    if ($user) {
        // Vérifie si l'utilisateur a le rôle "admin"
        if ($user->role !== 'admin') {
            Log::warning('Accès refusé : rôle insuffisant', ['name' => $request->name]);
            return response()->json(['message' => 'Vous n\'avez pas les autorisations nécessaires pour vous connecter.'], 403);
        }

        Auth::login($user);

        // Construit manuellement la réponse avec uniquement les données nécessaires
        return response()->json([
            'message' => 'Connexion réussie',
            'user' => [
                'id' => $user->id,
                'username' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ]
        ], 200);
    }

    // Retourne une réponse d'erreur si l'authentification échoue
    Log::error('Échec de la connexion', ['name' => $request->name]);
    return response()->json(['message' => 'Les informations de connexion sont incorrectes.'], 401);
}


   
    


    



    // Récupération utilisateur pour formulaire du profil
    public function getProfile()
{
    $user = Auth::user();
    if ($user) {
        // Vérifie et encode l'image de profil en base64 si elle existe
        if ($user->profile_picture) {
            $user->profile_picture = base64_encode($user->profile_picture);
        }
        
        return response()->json($user, 200);
    } else {
        return response()->json(['message' => 'Utilisateur non connecté'], 401);
    }
}


    // Déconnexion de l'utilisateur
    public function logout(Request $request)
{
    Auth::logout(); 
    return response()->json(['message' => 'Déconnexion réussie']);
}
}