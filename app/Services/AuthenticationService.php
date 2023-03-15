<?php

namespace App\Services;

use App\Contracts\AuthenticationServiceInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
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
        if (!Auth::attempt($loginRequest->validated())) {
            return response()->json([
                'message' => 'Unauthorised, please check the details that you have provided.'
            ], 403);
        }

        $user = Auth::getUser();

        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' =>  $token
        ], 200);
    }

    public function register(RegisterRequest $registerRequest)
    {
        $user = User::create([
            'username' => $registerRequest->username,
            'email' => $registerRequest->email,
            'password' => Hash::make($registerRequest->password),
            'avatar_url' => 'https://api.dicebear.com/5.x/thumbs/svg?backgroundColor=b6e3f4&seed=' . $registerRequest->email,
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return [
            'user' => new UserResource($user),
            'token' =>  $token
        ];
    }
}
