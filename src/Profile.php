<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\User;
use Dayplayer\BackendModels\Production;
use Dayplayer\BackendModels\Conversation;

class Profile extends BaseModel
{    
    public $casts = [
        'positions' => 'array',
        'boolean' => 'available',
    ];
    
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
