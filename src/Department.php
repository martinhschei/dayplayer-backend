<?php

namespace Dayplayer\BackendModels;

use Cviebrock\EloquentSluggable\Sluggable;
use Dayplayer\BackendModels\DepartmentJob;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Department extends BaseModel
{
    use Sluggable;
    use SluggableScopeHelpers;
    
    public function sluggable(): array 
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
            ];
    }
    
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
