<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class AvailabilitySettings extends BaseModel
{
    public $casts = [
        'pause_end' => 'date',
        'pause_start' => 'date',
    ];
}
