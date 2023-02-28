<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService ) {
      $this->authService = $authService;
    }

    public function register(Request $request) {
      return $this->authService->register($request);
    }

    public function login(Request $request) {
      return $this->authService->login($request);
    }

    public function logout(Request $request) {
      return $this->authService->logout($request);
    }

    public function profile(Request $request) {
      return $this->authService->profile($request);
    }
}
