<?php

namespace App\Services;

use App\Repositories\AuthRepository;

class AuthService
{
  private $authRepository;

  public function __construct(AuthRepository $authRepository)
  {
    $this->authRepository = $authRepository;
  }

  public function register($data){
    
    $rules = array (
      'name' => 'required|string',
			'email' => 'required|email|unique:users,email',
      'password' => 'required|string',
		);
		  
		$customErrors = array(
      'name.required' => 'O nome é obrigatório !',
      'name.string' => 'O nome está em formato inválido !',
			'email.required' => 'O email é obrigatório !',
      'email.email' => 'O email está em formato inválido !',
      'email.unique' => 'O email já está sendo utilizado !',
      'password.required' => 'A senha é obrigatoria !',
      'password.string' => 'A senha precisa ser string !',
    );

		$validated = validRules($data->toArray(), $rules, $customErrors);

    return $this->authRepository->register($validated);
  }

  public function login($data){
    
    $rules = array (
			'email' => 'required|email',
      'password' => 'required|string',
		);
		  
		$customErrors = array(
			'email.required' => 'O email é obrigatório !',
      'email.email' => 'O email está em formato inválido !',
      'password.required' => 'A senha é obrigatoria !',
      'password.string' => 'A senha precisa ser string !',
    );

		$validated = validRules($data->toArray(), $rules, $customErrors);

    return $this->authRepository->login($validated);
  }

  public function logout()
  {
    auth()->logout();
    
    return response()->json([
      'success' => true,
      'message' => 'Deslogado com sucesso'
    ]);
  }

  public function profile()
  {
    return $this->authRepository->profile(auth()->user()->id);
  }
}