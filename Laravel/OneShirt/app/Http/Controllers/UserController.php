<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private function convertToUtf8($data)
    {
        if (is_array($data)) {
            return array_map([$this, 'convertToUtf8'], $data);
        }
        if (is_string($data)) {
            return mb_convert_encoding($data, 'UTF-8', 'UTF-8');
        }
        return $data;
    }

    public function getAllUsers(): JsonResponse
    {
        $users = User::all();

        // Convertir les données en UTF-8
        $users = $this->convertToUtf8($users);

        // Encoder les images de profil en base64
        $users->transform(function ($user) {
            if ($user->profile_picture) {
                $user->profile_picture = base64_encode($user->profile_picture);
            }
            return $user;
        });

        return response()->json($users, 200, [], JSON_UNESCAPED_UNICODE);
    }


    public function getUserById($id): JsonResponse
{
    // Rechercher l'utilisateur par ID
    $user = User::find($id);

    if (!$user) {
        return response()->json(['error' => 'Utilisateur non trouvé'], 404);
    }

    // Encoder l'image de profil en base64 si elle existe
    if ($user->profile_picture) {
        $user->profile_picture = base64_encode($user->profile_picture);
    }

    // Retourner les données utilisateur au format JSON
    return response()->json($user);
}


    public function updateProfile(Request $request)
    {
        // Affiche les données reçues pour le débogage
        Log::info($request->all());
        
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'address' => 'nullable|string',
            'postal_address' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'profile_picture' => 'nullable|image|max:2048', // Limite de taille de l'image
        ]);
    
        $user = Auth::user(); // Récupérer l'utilisateur connecté
        
        if (!($user instanceof User)) {
            return response()->json(['error' => 'User is not an instance of User model'], 500);
        }
        
        // Mettre à jour les données de texte
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->postal_address = $request->postal_address;
        $user->phone_number = $request->phone_number;
        $user->date_of_birth = $request->date_of_birth;
    
        // Gérer le téléchargement de l'image
        try {
            if ($request->hasFile('profile_picture')) {
                $image = $request->file('profile_picture');
                $imageData = file_get_contents($image->getRealPath());
                $user->profile_picture = $imageData; // Stocker l'image dans la base de données
            }
        } catch (\Exception $e) {
            Log::error("Image processing failed: " . $e->getMessage());
            return response()->json(['error' => 'Image processing failed'], 500);
        }
        
        // Enregistrer les modifications
        try {
            $user->save(); // Enregistrer les modifications
        } catch (\Exception $e) {
            Log::error("Database save error: " . $e->getMessage());
            return response()->json(['error' => 'Failed to update profile'], 500);
        }

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }














    /* Ceci sont les différents CRUD 
    des utilisateurs pour le Dashboard
    */



    public function createUser(Request $request): JsonResponse
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
        'profile_picture' => 'nullable|image|max:2048',
        'role' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Initialisation de la variable pour l'image
    $profilePictureData = null;

    // Vérification si un fichier d'image a été téléchargé
    if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
        $image = $request->file('profile_picture');
        
        // Lecture de l'image en tant que données binaires
        $profilePictureData = file_get_contents($image->getRealPath());
    }

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
        'role' => $validatedData['role'],
        'profile_picture' => $profilePictureData,  // Enregistrement de l'image dans la base de données
    ]);

    // Message de Réussite
    return response()->json(['message' => 'Création du compte effectuée.']);
}


    



public function updateUser(Request $request, $id): JsonResponse
{
    Log::info($request->all());

    // Validation des champs (on ne valide 'profile_picture' que si un fichier est fourni)
    $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'username' => 'required|string',
        'email' => 'required|email',
        'address' => 'nullable|string',
        'postal_address' => 'nullable|string',
        'phone_number' => 'nullable|string',
        'date_of_birth' => 'nullable|date',
        'role' => 'required|string',
    ];

    // On ajoute la validation pour 'profile_picture' uniquement si un fichier est présent
    if ($request->hasFile('profile_picture')) {
        $rules['profile_picture'] = 'image';
    }

    $request->validate($rules);

    // Récupération de l'utilisateur
    $user = User::findOrFail($id);

    // Mise à jour des autres champs de l'utilisateur
    $user->fill($request->except('profile_picture'));

    // Vérification et traitement de l'image si elle est présente
    if ($request->hasFile('profile_picture')) {
        try {
            $image = $request->file('profile_picture');

            // Si le fichier est valide et si c'est bien une image
            if ($image->isValid()) {
                $imageData = file_get_contents($image->getRealPath());
                $user->profile_picture = $imageData;  // Sauvegarde de l'image dans la base de données
            } else {
                return response()->json(['error' => 'Le fichier envoyé n\'est pas une image valide.'], 400);
            }
        } catch (\Exception $e) {
            Log::error("Erreur lors du traitement de l'image : " . $e->getMessage());
            return response()->json(['error' => 'Le traitement de l\'image a échoué.'], 500);
        }
    }

    // Sauvegarde des modifications dans la base de données
    try {
        $user->save();
        return response()->json(['message' => 'Utilisateur mis à jour avec succès.']);
    } catch (\Exception $e) {
        Log::error("Erreur lors de la mise à jour de l'utilisateur dans la base de données : " . $e->getMessage());
        return response()->json(['error' => 'Échec de la mise à jour de l\'utilisateur.'], 500);
    }
}






public function deleteUser($id): JsonResponse
{
    $user = User::find($id);
    if (!$user) {
        return response()->json(['error' => 'Utilisateur non trouvé'], 404);
    }

    try {
        $user->delete();
        return response()->json(['message' => 'Utilisateur supprimé avec succès'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Échec de la suppression'], 500);
    }
}


}
