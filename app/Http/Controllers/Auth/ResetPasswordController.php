<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ResetPasswordService;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * @var ResetPasswordService
     */
    protected $service;

    /**
     * Create a new controller instance.
     *
     * @param ResetPasswordService $service
     */
    public function __construct(ResetPasswordService $service)
    {
        $this->service = $service;
        $this->middleware('guest');
    }


    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        return $this->service->create($request->all());
    }

    public function find($token)
    {
        return $this->service->find($token);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' =>      'required|string|email',
            'password' =>   'required|string|confirmed',
            'token' =>      'required|string'
        ]);
        return $this->service->reset($request);
    }
}
