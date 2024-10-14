<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}
