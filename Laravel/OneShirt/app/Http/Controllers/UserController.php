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

    $users->map(function ($user) {
        if ($user->profile_picture) {
            $user->profile_picture = base64_encode($user->profile_picture);
        }
        return $user;
    });

    return response()->json($users, 200, [], JSON_UNESCAPED_UNICODE);
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
        
        if (!($user instanceof \App\Models\User)) {
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
        
    
        try {
            $user->save(); // Enregistrer les modifications
        } catch (\Exception $e) {
            Log::error("Database save error: " . $e->getMessage());
            return response()->json(['error' => 'Failed to update profile'], 500);
        }
        
    }
    

}