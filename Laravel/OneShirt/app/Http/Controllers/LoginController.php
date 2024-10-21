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
    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:8',
    ]);

    Log::info('Données de connexion:', $request->all());

    $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    // Trouver l'utilisateur par nom d'utilisateur ou email
    $user = User::where($fieldType, $request->name)->first();

    if ($user && Hash::check($request->password, $user->password_hash)) {
        Auth::login($user);
        return response()->json(['message' => 'Connexion réussie', 'user' => Auth::user()], 200);
    }

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
