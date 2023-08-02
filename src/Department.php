<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\DepartmentJob;

class Department extends BaseModel
{
    public function jobs()
    {
        return $this->hasMany(DepartmentJob::class);
    }
    
    public function jobsWithoutBooking()
    {
        return $this->jobs()->whereNull('booked_profile');
    }

    public function jobsWithBooking()
    {
        return $this->jobs()->whereNotNull('booked_profile');
    }
    
    public function manager()
    {
        return [
            'name' => $this->manager_name,
            'email' => $this->manager_email,
        ];
    }
    
    public function managerAsUser()
    {
        return User::where('email', $this->manager_email)->first();
    }
}
