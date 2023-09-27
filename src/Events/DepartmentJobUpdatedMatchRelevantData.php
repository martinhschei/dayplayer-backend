<?php

namespace Dayplayer\BackendModels\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Dayplayer\BackendModels\DepartmentJob;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DepartmentJobUpdatedMatchRelevantData
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $departmentJob;

    public function __construct(DepartmentJob $departmentJob)
    {
        $this->departmentJob;
    }
}
