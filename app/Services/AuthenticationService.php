<?php

namespace App\Services;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthenticationService
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
        return true;
    }

    public function register(RegisterRequest $registerRequest)
    {
        return true;
    }

    public function logout()
    {
        return true;
    }
}
