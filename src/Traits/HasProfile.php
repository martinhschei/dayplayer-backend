<?php

namespace Dayplayer\BackendModels\Traits;

use Dayplayer\BackendModels\Profile;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

trait HasProfile
{
    use HybridRelations;
    
    public function profileId()
    {
        return $this->profile->id;
    }

    public function profile(): \Illuminate\Database\Eloquent\Relations\HasOne|\Jenssegers\Mongodb\Relations\HasOne
    {
        return $this->hasOne(Profile::class);
    }
}
