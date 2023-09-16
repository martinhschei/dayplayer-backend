<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\User;
use Dayplayer\BackendModels\Production;
use Dayplayer\BackendModels\Conversation;
use Dayplayer\BackendModels\Helpers\AppData;

class Profile extends BaseModel
{   
    public $casts = [
        'positions' => 'array',
        'boolean' => 'available',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class);
    }
}