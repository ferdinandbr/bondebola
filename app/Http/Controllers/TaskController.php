<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService ) {
      $this->taskService = $taskService;
    }

    public function listTasks(Request $request) {
      return $this->taskService->listTasks($request);
    }
}
