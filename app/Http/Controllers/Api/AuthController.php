<?php

namespace App\Http\Controllers\Api;

use App\Contracts\AuthenticationServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $authenticationService;

    public function __construct(AuthenticationServiceInterface $_authenticationService)
    {
        $this->authenticationService = $_authenticationService;
    }

    public function login(LoginRequest $request)
    {
        try {
            return $this->authenticationService->login($request);
        } catch(Exception $e) {
            return response()->json([
               'message' => $e
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        try {
            $res = $this->authenticationService->register($request);
            return response($res, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
}
