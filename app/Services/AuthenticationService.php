<?php

namespace App\Services;

use App\Contracts\AuthenticationServiceInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Exception;
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
        if (auth()->attempt($loginRequest->all())) {
           $user = auth()->user();
           dd($user);
           $token = $user->createToken('authToken')->accessToken->token;
           return [
               'user' => $user,
               'token' =>  $token
            ];
        }
    }

    public function register(RegisterRequest $registerRequest)
    {
        return User::create([
            'first_name' => $registerRequest->first_name,
            'last_name' => $registerRequest->last_name,
            'username' => $registerRequest->username,
            'email' => $registerRequest->email,
            'password' => Hash::make($registerRequest->password)
        ]);
    }
}
