<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\Gig;
use Dayplayer\BackendModels\BaseModel;

class Production extends BaseModel
{    
    public function jobs()
    {
        return $this->hasMany(ProductionJob::class);
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
