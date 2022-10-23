<?php

namespace App\Services;

use App\Contracts\AuthenticationServiceInterface;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationService implements AuthenticationServiceInterface
{
    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function login(LoginRequest $loginRequest)
    {
    }

    public function register(Request $registerRequest)
    {
        return User::create([
            'first_name' => $$registerRequest->first_name,
            'last_name' => $$registerRequest->last_name,
            'username' => $$registerRequest->username,
            'email' => $$registerRequest->email,
            'password' => Hash::make($$registerRequest->password)
        ]);
    }

    public function logout()
    {
        return true;
    }
}
