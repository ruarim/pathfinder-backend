<?php

namespace App\Services;

use App\Contracts\AuthenticationServiceInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationService implements AuthenticationServiceInterface
{
    /**
     * Class constructor.
     *
     * @return void
     */

    public function login(Request $loginRequest)
    {
        $credentials = $loginRequest->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorised, please check the details that you have provided.'
             ], 404);
        }

        $user = Auth::getUser();
        dd($user);
    }

    public function register(RegisterRequest $registerRequest)
    {
        $user = User::create([
            'first_name' => $registerRequest->first_name,
            'last_name' => $registerRequest->last_name,
            'username' => $registerRequest->username,
            'email' => $registerRequest->email,
            'password' => Hash::make($registerRequest->password)
        ]);

        $token = $user->createToken('authToken')->accessToken->token;

        return [
            'user' => $user,
            'token' =>  $token
        ];
    }
}
