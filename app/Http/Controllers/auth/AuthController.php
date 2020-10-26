<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validData = $request->validate([
                'name'  => 'required',
                'email' => 'required|email',
                'password' => 'required'
            ]);
            $user = User::store($validData);
            $accessToken = $user->createToken('authToken')->accessToken;
            return json_encode([
                'success' => true,
                'error' => [],
                'user'  => $user,
                'accessToken'   => $accessToken,
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'success'   => false,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $validData = $request->validate([
                'email' => 'required|email',
                'password'  => 'required'
            ]);
            auth()->attempt($validData);
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            return json_encode([
                'success' => true,
                'error' => [],
                'user'  => Auth::user(),
                'accessToken'   => $accessToken,
            ]);

        } catch (\Exception $e) {
            return json_encode([
                'success'   => false,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
