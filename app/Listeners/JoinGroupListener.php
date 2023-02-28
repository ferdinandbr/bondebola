<?php

namespace App\Listeners;

use App\Events\JoinGoupEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Usergroup;
use App\Models\Group;

class JoinGroupListener implements ShouldQueue
{ 
  private $group;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Group $group)
    {
      $this->group = $group;
    }

    /**
     * Handle the event.
     *
     * @param  JoinGoupEvent  $event
     * @return void
     */
    public function handle(JoinGoupEvent $event)
    {
      $data = array(
        'user_id' => $event->id,
        'group_id' => $event->user_id,
      );
      UserGroup::create($data);
    }
}
