<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15',
            'birthdate' => 'required|date',
            'address' => 'required|string|max:255',
            'postalcode' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Création du nouvel utilisateur
        $user = User::create([
            'username' => $validatedData['username'],
            'first_name' => $validatedData['firstname'],
            'last_name' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone'],
            'date_of_birth' => $validatedData['birthdate'],
            'address' => $validatedData['address'],
            'postal_address' => $validatedData['postalcode'],
            'password_hash' => Hash::make($validatedData['password']),  // Hashage du mot de passe
        ]);

        // Authentification automatique de l'utilisateur après inscription
        Auth::login($user);

        // Message de Réussite
        return response()->json(['message' => 'Inscription réussie!']);
    }
}
