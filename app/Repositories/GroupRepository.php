<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Group;

class GroupRepository{

  protected $group;

  public function __construct(Group $group) 
  {
    $this->group = $group;
  }

	public function createGroup($data)
  {
   try {
    $this->group->name = $data['name'];
    $this->group->description = $data['description'];
    $this->group->invite_code = uniqid();
    $this->group->user_id = auth()->user()->id;
    $this->group->save();

    return $this->group;

   } catch (\Throwable $th) {
    abort(409, 'Erro ao criar o racha. Por favor tente novamente em alguns minutos');
   }
  }
}