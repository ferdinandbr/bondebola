<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Group;
use App\Events\JoinGroupEvent;

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

      event(new JoinGroupEvent($this->group));

      return $this->group;

    } catch (\Throwable $th) {
      return $th->getMessage();
      abort(409, 'Erro ao criar o racha. Por favor tente novamente em alguns minutos');
    }
  }
}