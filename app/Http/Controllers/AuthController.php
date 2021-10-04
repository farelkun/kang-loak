<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repository\AuthRepository;

class AuthController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository){
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequest $request)
    {
        return $this->authRepository->login($request);   
    }

    public function register(RegisterRequest $request)
    {   
        return $this->authRepository->register($request);  
    }

    public function logout(Request $request)
    {   
        return $this->authRepository->logout($request);  
    }
}
