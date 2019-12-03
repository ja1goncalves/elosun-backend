<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service  = $service;
    }

    public function getUserAuthenticated()
    {
        $response = $this->service->getUserByToken();
        return response()->json($response, $response['error'] ? 500 : 200);
    }

//    public function confirmSignUp()
//    {
//        return $this->service->sendConfirmSignUp();
//    }
//
    public function signUpActivate($token)
    {
        return $this->service->signUpActivate($token);
    }

    public function destroyToken(){
        return $this->service->destroyToken();
    }
}
