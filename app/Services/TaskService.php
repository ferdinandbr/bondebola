<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
  private $taskRepository;

  public function __construct(TaskRepository $taskRepository)
  {
    $this->taskRepository = $taskRepository;
  }

  public function listTasks($data){
    
    $rules = array (
      'status' => 'required|string|in:all,in_progress,completed,canceled',
			'assigned_to' => 'required|string|in:me,other',
		);
		  
		$customErrors = array(
      'status.required' => 'O status passado é obrigatório !',
      'status.string' => 'O status passado está inválido !',
      'status.in' => 'O status passado é inválido !',
      'assigned_by.required' => 'Atribuição é obrigatória !',
      'assigned_by.string' => 'Atribuição está em formato inválido !',
      'assigned_to.in' => 'Atribuição está em formato inválido !',
    );

		$validated = validRules($data->toArray(), $rules, $customErrors);

    return $this->taskRepository->listTasks($validated);
  }
}