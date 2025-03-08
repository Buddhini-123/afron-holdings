<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Welcome back, ' . Auth::user()->name . '!',
            ], 200);
        }

        return response()->json(['error' => 'Invalid username or password.'], 401);
    }

}
