<?php

namespace Dayplayer\BackendModels\Traits;

use Dayplayer\BackendModels\Profile;

trait HasProfile
{
    use HybridRelations;
    
    public function profileId()
    {
        return $this->profile->id;
    }
    
    public function getProfileAttribute()
    {
        return Profile::where('user_id', $this->id)->first();
    }
}
