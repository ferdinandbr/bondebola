<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Task;

class TaskRepository{

  private $task;
  private $user;

  public function __construct(User $user, Task $task) 
  {
    $this->user = $user;
    $this->taks = $task;
  }

	public function listTasks($data)
  {
    return $this->user
      ->where('id', auth()->user()->id)
      ->when($data['assigned_to'] == 'me', function ($q) use ($data) {
        return $q->whereHas('myTasks', function ($query) use ($data) {
          if ($data['status'] !== 'all') {
            $query->where('status', $data['status']);
          }
        })->with(['myTasks' => function ($query) use ($data) {
          if ($data['status'] !== 'all') {
            $query->where('status', $data['status']);
          }
        }]);
      })
      ->when($data['assigned_to'] == 'other', function ($q) use ($data) {
          return $q->whereHas('taskAssignedTo', function ($query) use ($data) {
              if ($data['status'] !== 'all') {
                $query->where('status', $data['status']);
              }
          })->with(['taskAssignedTo' => function ($query) use ($data) {
              if ($data['status'] !== 'all') {
                $query->where('status', $data['status']);
              }
          }]);
      })->get();
  }
}