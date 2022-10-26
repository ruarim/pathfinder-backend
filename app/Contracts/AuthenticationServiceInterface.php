<?php

namespace App\Contracts;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

interface AuthenticationServiceInterface
{
    public function login(LoginRequest $loginRequest);
    public function register(RegisterRequest $registerRequest);
    public function logout();
}
