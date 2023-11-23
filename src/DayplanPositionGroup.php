<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class DayplanPositionGroup extends BaseModel
{
    public function getIsContinuousAttribute()
    {
        $isContinuous = true;
        $previousDate = null;
        $dates = $this->positions->map->date;

        foreach ($dates as $date) {
            if ($previousDate && ! $previousDate->addDay()->equalTo($date)) {
                $isContinuous = false;
                break;
            }

            $previousDate = $date;
        }
        
        return $isContinuous;
    }

    public function jobOffers()
    {
        return $this->morphMany(JobOffer::class, 'offerable');
    }

    public function getStartAttribute()
    {
        return $this->positions->first()->date;    
    }
    
    public function getEndAttribute()
    {
        return $this->positions->last()->date;
    }

    public function getDurationAttribute()   
    {
        return $this->positions->count();
    }
    
    public function positions()
    {
        return $this->hasMany(DayplanPosition::class);
    }
}
