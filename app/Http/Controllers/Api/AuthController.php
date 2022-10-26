<?php

namespace App\Http\Controllers\Api;

use App\Contracts\AuthenticationServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function login(Request $request)
    {
        dd('hello world');
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
            $user = $this->authenticationService->register($request);
            return response($user, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout($id)
    {
        //
    }
}
