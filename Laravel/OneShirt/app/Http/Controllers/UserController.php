<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{
    public function getAllUsers(): JsonResponse
    {
        $users = User::all();

        // Traiter chaque utilisateur pour encoder l'image de profil en base64
        $users->map(function ($user) {
            if ($user->profile_picture) {
                $user->profile_picture = base64_encode($user->profile_picture);
            }
            return $user;
        });

        return response()->json($users, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function updateProfile(Request $request): JsonResponse
{
    $user = Auth::user(); // Récupérer l'utilisateur connecté

    if (!$user || !($user instanceof User)) {
        return response()->json(['message' => 'Utilisateur non connecté'], 401);
    }


    // Valider les données du formulaire
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'address' => 'nullable|string|max:255',
        'postal_address' => 'nullable|string|max:255',
        'phone_number' => 'nullable|string|max:20',
        'date_of_birth' => 'nullable|date',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Gestion de l'image de profil
    if ($request->hasFile('profile_picture')) {
        // Lire le contenu du fichier
        $image = file_get_contents($request->file('profile_picture')->getRealPath());

        // Enregistrez l'image dans la base de données
        $user->profile_picture = $image; // Assuming 'profile_picture' is the LONG BLOB column
    }

    // Mettre à jour les informations de l'utilisateur
    $user->update($validatedData);

    // Vous pouvez également retourner les informations de l'utilisateur après mise à jour
    return response()->json(['message' => 'Profil mis à jour avec succès', 'user' => $user], 200);
}


}
