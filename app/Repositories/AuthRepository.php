<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository{

	public function login($data)
  {
    if (!$token = auth()->attempt(["email" => $data['email'], "password" => $data['password']]))
    {
      return response()->json([
        'success' => false,
        'message' => 'Credenciais inválidas'
      ],401);
      }
      
      return response()->json([
        'success' => true,
        'message' => 'Login realizado com sucesso',
        'user' => auth()->user(),
        'access_token' => $token
      ]);
  }

  public function register($data) 
  {
    $user = new User();
    try {
      $user->create($data);

      return response()->json([
        'success' => true,
        'message' => "Usuário registrado com sucesso."
      ]);

    } catch (\Throwable $th) {
      return response()->json([
        'success' => false,
        'message' => "Erro ao se registrar. Entre em contato com o administrador do sistema"
      ],401);
    }
  }
}