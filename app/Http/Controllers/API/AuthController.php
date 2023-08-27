<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user = User::create($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['data'=>$user,'excess_token'=>$token]);
    }

    public function login(LoginRequest $request) {
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials))
            return response()->json(['message' => 'Unauthorized'], 401);

        $user = User::where(['email', $credentials['email']])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => "Welcome {$user->name}", 'auth_token' => $token]);
    }
}
