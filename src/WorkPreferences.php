<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class WorkPreferences extends BaseModel
{
    public $casts = [
        'positions' => 'array',
        'last_positions' => 'array',
        'night_shoots' => 'boolean',
        'available_in_weekends' => 'boolean',
    ];
}
