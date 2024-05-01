<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{   
    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|confirmed'
        ]);
    
        $validatedData['password'] = bcrypt($request->password);
    
        $user = User::create($validatedData);
    
        $accessToken = $user->createToken('authToken')->plainTextToken;
    
        return response(['user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request){
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('MyApp')->plainTextToken;
        return response()->json(['user' => $user,'token' => $token], 200);
    } else {
        return response()->json(['error' => 'Unauthorised'], 401);
    }
    }

    public function logout(Request $request){
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
