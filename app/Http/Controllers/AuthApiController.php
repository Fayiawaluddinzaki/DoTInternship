<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    //
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|string|email|unique:users|max:200',
            'password' => 'required|string|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' =>bcrypt($request->password)
            'password' => Hash::make($request->password)
        ]);

        $secret =$user->createToken('auth-sanctum')->plainTextToken;

        return response()->json([
            'message' => 'Successfully created user!',
            'user' => $user,
            'token' => $secret,
            'token_type' => 'Bearer'
        ], 201);
    }

    public function login(Request $request)
    {
        $request-> validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if(!auth()->attempt($request->only('email', 'password')
        )) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $secret = $user->createToken('auth-sanctum')->plainTextToken;

        return response()->json([
            'message' => 'Successfully login',
            'user' => $user,
            'token' => $secret,
            'token_type' => 'Bearer'
        ], 200);
    }
}
