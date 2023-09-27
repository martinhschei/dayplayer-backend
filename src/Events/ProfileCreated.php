<?php

namespace Dayplayer\BackendModels\Events;

use Dayplayer\BackendModels\Profile;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProfileCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $profile;
    
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }
}
