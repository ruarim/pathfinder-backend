<?php

namespace App\Contracts;

interface AuthenticationInterface
{
    public function login();
    public function register();
    public function logout();
}
