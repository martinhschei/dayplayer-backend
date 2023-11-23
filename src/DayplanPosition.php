<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class DayplanPosition extends BaseModel
{
    public $casts = [
        'date' => 'date',
    ];
    
    public function dayplan()
    {
        return $this->belongsTo(Dayplan::class);
    }
    
    public function jobOffers()
    {
        return $this->morphMany(JobOffer::class, 'offerable');
    }
    
    public function dayplanPositionGroup()
    {
        return $this->belongsTo(DayplanPositionGroup::class);
    }

    public function getDurationsAttribute()
    {
        return 1;
    }
    
    public function getStartAttribute()
    {
        if (is_null($this->dayplan_position_group_id)) {
            return $this->date;
        }

        return $this->dayplanPositionGroup->positions()->orderBy('date')->get()->first()->date;
    }
    
    public function getEndAttribute()
    {
        if (is_null($this->dayplan_position_group_id)) {
            return $this->date;
        }   

        return $this->dayplanPositionGroup->positions()->orderBy('date')->get()->last()->date;
    }
}
