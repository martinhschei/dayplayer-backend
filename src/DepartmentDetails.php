<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class DepartmentDetails extends BaseModel
{
    public $casts = [
        'positions' => 'array',
    ];
}
