<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository{

  private $user;

  public function __construct(User $user)
  {
    $this->user = $user;
  }

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
    try {
      $this->user->create($data);

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

  public function profile($userId)
  {
    return $this->user->where('id', $userId)
      ->with('myGroups')
      ->first();
  }
}