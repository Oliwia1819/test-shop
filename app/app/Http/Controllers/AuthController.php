<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|email:dns|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

//        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
//            'token' => $token,
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:dns|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!Auth::attempt($validated)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = Auth::user();


//        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
//            'token' => $token,
        ]);
    }

}
