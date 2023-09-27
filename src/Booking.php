<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class Booking extends BaseModel
{
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    
    public function departmentJob()
    {
        return $this->belongsTo(DepartmentJob::class);
    }

    public function jobProfileMatch()
    {
        return $this->belongsTo(JobProfileMatch::class);
    }
}