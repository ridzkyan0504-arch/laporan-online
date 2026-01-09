<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    // Register new user (creates personal access token)
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => 'User registered successfully',
            'token'   => $token,
            'user'    => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
        ], 201);
    }

    // Login and create token
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user  = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
        ], 200);
    }

    // Return current authenticated user profile
    // Route should be protected by auth:sanctum
    public function profile(Request $request)
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }

        return response()->json([
            'status' => true,
            'user'   => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
        ]);
    }

    // Logout: delete current access token (for Bearer tokens created via createToken)
    // Route should be protected by auth:sanctum
    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if ($user) {
                // If token-based (Sanctum Personal Access Token), revoke the current token
                if (method_exists($user, 'currentAccessToken') && $user->currentAccessToken()) {
                    $user->currentAccessToken()->delete();
                    return response()->json(['status' => true, 'message' => 'Logged out'], 200);
                }

                // Fallback: delete all tokens (if desired)
                if (method_exists($user, 'tokens')) {
                    $user->tokens()->delete();
                    return response()->json(['status' => true, 'message' => 'Logged out (all tokens revoked)'], 200);
                }
            }

            // If no authenticated user, still return OK to keep client flow simple
            return response()->json(['status' => true, 'message' => 'No active token'], 200);
        } catch (\Throwable $e) {
            // Log the exception for debugging and return a safe error to client
            Log::error('Logout error: '.$e->getMessage(), ['exception' => $e]);
            return response()->json(['status' => false, 'message' => 'Logout failed'], 500);
        }
    }
}