<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\Booking;
use Dayplayer\BackendModels\Profile;
use Dayplayer\BackendModels\BaseModel;
use Dayplayer\BackendModels\DepartmentJob;

class JobProfileMatch extends BaseModel
{    
    public $with = ['profile', 'departmentJob', 'booking'];
    
    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
    
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    
    public function departmentJob()
    {
        return $this->belongsTo(DepartmentJob::class);
    }
    
    public function createBooking()
    {
        if ($this->booking) {
            throw new \Exception('Booking already exists for this match.');
        }

        return $this->booking()->create();
    }
}