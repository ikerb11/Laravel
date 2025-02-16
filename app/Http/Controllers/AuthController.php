<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if (!$user instanceof User) {
                $user = new User();
            }
            // Crear un token solo si el usuario existe
            if ($user) {
                $token = $user->createToken('auth_token')->accessToken;
                return response()->json(['token' => $token, 'user' => $user], 200);
            }
        }
    
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }
    public function userProfile(Request $request)
    {
        return response()->json(['user' => Auth::user()], 200);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
    }


}
