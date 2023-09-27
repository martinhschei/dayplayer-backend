<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\User;
use Dayplayer\BackendModels\BaseModel;
use Dayplayer\BackendModels\Production;
use Dayplayer\BackendModels\Conversation;
use Dayplayer\BackendModels\Helpers\AppData;
use Dayplayer\BackendModels\JobProfileMatch;
use Dayplayer\BackendModels\Events\ProfileCreated;
use Dayplayer\BackendModels\Events\ProfileUpdatedMatchRelevantData;

class Profile extends BaseModel
{   
    public $casts = [
        'positions' => 'array',
        'boolean' => 'available',
    ];
        
    protected static function booted()
    {
        static::updated(function ($profile) {
            if ($profile->isDirty(['available', 'positions'])) {
                event(new ProfileUpdatedMatchRelevantData($profile));
            }
        });
        
        static::created(function ($profile) {
            event(new ProfileCreated($profile));
        });
    }

    public function isAvailable()
    {
        return $this->available;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class);
    }
    
    public function jobMatches()
    {
        return $this->hasMany(JobProfileMatch::class);
    }
}