<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\Gig;
use Dayplayer\BackendModels\BaseModel;

class Production extends BaseModel
{    
    public function gigs()
    {
        return $this->hasMany(Gig::class);
    }
    
    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function admin()
    {
        return $this->hasOne(User::class, 'user_id');
    }
    
    public function getProductNameAttribute()
    {
        return "{$this->name} // {$this->start_date}-{$this->end_date}";
    }
}
