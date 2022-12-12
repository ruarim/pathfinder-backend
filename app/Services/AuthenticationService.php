<?php

namespace App\Services;

use App\Contracts\AuthenticationServiceInterface;
use App\Http\Resources\UserResource;
use App\Models\User;
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

        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' =>  $token
        ], 200);
    }

    public function register(Request $registerRequest)
    {
        $user = User::create([
            'first_name' => $registerRequest->first_name,
            'last_name' => $registerRequest->last_name,
            'username' => $registerRequest->username,
            'email' => $registerRequest->email,
            'password' => Hash::make($registerRequest->password)
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return [
            'user' => new UserResource($user),
            'token' =>  $token
        ];
    }
}
