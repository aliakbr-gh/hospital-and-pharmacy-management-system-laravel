<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
        public function register(Request $request)
        {
            $request->validate([
                'username' => 'required|unique:users',
                'password' => 'required|min:4',
                'role' => 'required',
            ]);

            $user = User::create([
                'username' => $request->username,
                'phone' => $request->phone,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'is_active' => 1
            ]);

            return APIResponse::success("User registered successfully", $user, 201);
        }

        public function login(Request $request)
        {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return APIResponse::success("Login successfully", Auth::user());
            }

            return APIResponse::error('Invalid credentials', [], 401);
        }

        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return APIResponse::success("Logged out successfully");
        }
}
