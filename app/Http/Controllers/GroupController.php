<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GroupService;

class GroupController extends Controller
{
    private $groupService;

    public function __construct(GroupService $groupService ) {
      $this->groupService = $groupService;
    }

    public function createGroup(Request $request) {
      return $this->groupService->createGroup($request);
    }
}
