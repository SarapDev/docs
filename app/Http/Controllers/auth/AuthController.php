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
        $validData = $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::store($validData);

        if($user) {

            $accessToken = $user->createToken('authToken')->accessToken;

            return json_encode([
                'success' => true,
                'error' => [],
                'user'  => $user,
                'accessToken'   => $accessToken,
            ]);

        } else {

            return json_encode([
                'success'   => false,
                'error' => 'No user',
            ]);
        }
    }

    public function login(Request $request)
    {
        $validData = $request->validate([
            'email' => 'required|email',
            'password'  => 'required'
        ]);
        if(Auth::attempt($validData)) {
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            return json_encode([
                'success' => true,
                'error' => [],
                'user'  => Auth::user(),
                'accessToken'   => $accessToken,
            ]);
        } else {
            return json_encode([
                'success' => false,
                'error' => 'Invalid login data',
            ]);
        }

    }
}
