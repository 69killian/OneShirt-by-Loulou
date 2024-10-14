<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserInfo($id)
    {
        $user = User::find($id);

        if ($user) {
            if ($user->profile_picture) {
                $user->profile_picture = base64_encode($user->profile_picture);
            }

            return response()->json($user, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
    }
}

