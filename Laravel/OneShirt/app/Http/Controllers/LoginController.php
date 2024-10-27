<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validation des champs
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        // Logging des données de connexion (attention à ne pas loguer le mot de passe pour la sécurité)
        Log::info('Tentative de connexion', ['name' => $request->name]);
    
        // Détermination du type de champ (email ou nom d'utilisateur)
        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
        // Recherche de l'utilisateur
        $user = User::where($fieldType, $request->name)->first();
    
        if ($user && Hash::check($request->password, $user->password_hash)) {
            // Connexion de l'utilisateur
            Auth::login($user);
    
            // Préparation des données utilisateur pour la réponse JSON
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                // Ajoutez d'autres informations si nécessaire
            ];
    
            Log::info('Connexion réussie pour l\'utilisateur', ['user_id' => $user->id]);
    
            // Retourne une réponse JSON avec l'option JSON_UNESCAPED_UNICODE
            return response()->json(['message' => 'Connexion réussie', 'user' => $userData], 200, [], JSON_UNESCAPED_UNICODE);
        }
    
        // Si les informations sont incorrectes
        Log::error('Échec de la connexion', ['name' => $request->name]);
        return response()->json(['message' => 'Les informations de connexion sont incorrectes'], 401);
    }
    



    // Pour formulaire du profil
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



    public function logout(Request $request)
    {
        Auth::logout(); // Déconnexion de l'utilisateur
        return response()->json(['message' => 'Déconnexion réussie']);
    }
}