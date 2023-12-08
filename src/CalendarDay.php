<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;
 
class CalendarDay extends BaseModel
{
    public $casts = [
        'date' => 'date',
    ];
    
    public const STATUS_BOOKED = "booked";
    public const STATUS_VACATION = "vacation";
    public const STATUS_RESTRICTED = "restricted";
    public const STATUS_UNAVAILBLE = "unavailable";
}
