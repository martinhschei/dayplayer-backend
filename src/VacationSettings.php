<?php

namespace Dayplayer\BackendModels;

use Carbon\CarbonPeriod;
use Dayplayer\BackendModels\BaseModel;

class VacationSettings extends BaseModel
{
    public $casts = [
        'pause_end' => 'date',
        'pause_start' => 'date',
    ];

    public function hasVacationPeriod()
    {
        return $this->pause_start && $this->pause_end;
    }

    public function getVacationDates() {
        if (!$this->hasVacationPeriod()) {
            return [];
        }

        $dates = [];
        $period = CarbonPeriod::create($this->pause_start, $this->pause_end);
        
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }
        
        return collect($dates);
    }
}
