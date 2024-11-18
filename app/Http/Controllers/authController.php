<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function register(Request $request){
        // $user = User::create($request -> all());
        // return response()->json($user);
        
        try{
            $user = User::create($request->all());
            return response()->json($user, 201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Error al registrar el usuario.'], 500); // Código de error 500
        }
    }


    public function login()
    {
        try {
            $credentials = request(['email', 'password']);

            if (! $token = Auth::attempt($credentials)) {
                return response()->json(['error' => 'No autorizado'], 401);
            }
            $user = Auth::guard('api')->user();

            return $this->respondWithToken($token,  $user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al iniciar sesión.'], 500); // Código de error 500
        }
    }


    protected function respondWithToken($token, $admin)
    {
        return response()->json([
            'access_token' => $token, 
            'token_type' => 'bearer', 
            'expires_in' => Auth::factory()->getTTL() * 60, 
            'admin' => $admin,
        ]);
    }


}
