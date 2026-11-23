<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use illuminate\http\request;


class AuthController extends Controller
{
    public function login(Request $request): JsonResponse{
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'success' => false,
                'message' => 'credenciales incorrectas',
            ],401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'success' => true,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',

        ],201);
    }
}
