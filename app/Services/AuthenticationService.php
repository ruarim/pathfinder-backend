<?php

namespace App\Services;

use App\Contracts\AuthenticationServiceInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationService implements AuthenticationServiceInterface
{
    /**
     * Class constructor.
     *
     * @return void
     */

    public function login(LoginRequest $loginRequest)
    {

        $credentials = $loginRequest->only(['username', 'password']);
        if (!Auth::once($credentials)) {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

        $user = Auth::getUser();
        $token = $user->createToken('authToken')->accessToken->token;
        return response()->json([
            'user' => $user,
            'token' =>  $token
        ], 200);
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
