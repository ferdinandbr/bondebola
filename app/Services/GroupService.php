<?php

namespace App\Services;

use App\Repositories\GroupRepository;

class GroupService
{
  private $groupRepository;

  public function __construct(GroupRepository $groupRepository)
  {
    $this->groupRepository = $groupRepository;
  }

  public function createGroup($data){

    checkCanCreate(auth()->user()->id);
    
    $rules = array (
      'name' => 'required|string',
			'description' => 'required|string',
		);
		  
		$customErrors = array(
      'name.required' => 'O nome é obrigatório !',
      'name.string' => 'O nome está em formato inválido !',
      'description.required' => 'A descrição é obrigatória !',
      'description.string' => 'A descrição está em formato inválida !',
    );

		$validated = validRules($data->toArray(), $rules, $customErrors);

    return $this->groupRepository->createGroup($validated);
  }
}