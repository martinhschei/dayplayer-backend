<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;
use Dayplayer\BackendModels\Department;
use Dayplayer\BackendModels\DayplanPosition;

class Dayplan extends BaseModel
{
    public $with = ['positions'];

    public $casts = [
        'date' => 'date',
    ];
    
    public function positions()
    {
        return $this->hasMany(DayplanPosition::class);
    }
    
    public function dayplanGroup()
    {
        return $this->belongsTo(DayplanGroup::class);
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
