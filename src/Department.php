<?php

namespace Dayplayer\BackendModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Dayplayer\BackendModels\User;
use Illuminate\Support\Facades\Hash;
use Dayplayer\BackendModels\BaseModel;
use Dayplayer\BackendModels\Production;
use Dayplayer\BackendModels\DayplanGroup;
use Dayplayer\BackendModels\DepartmentJob;
use Dayplayer\BackendModels\Helpers\AppData;
use Dayplayer\BackendModels\DepartmentDetails;
use Dayplayer\BackendModels\DayplanPositionGroup;

class Department extends BaseModel
{
    public $with = ['details'];
    
    public function shouldNotifyManager()
    {
        return ! $this->isManagerInvited() && ! $this->authUserIsManager();
    }
    
    public function authUserIsManager()
    {
        if (is_null($this->manager)) {
            return $this->manager_email === auth()->user()->email;
        }

        else {
            return $this->manager->id === auth()->id();
        }
    }
    
    public function schedule()
    {
        return $this->hasMany(Dayplan::class);
    }

    public function positionGroups()
    {
        return $this->hasMany(DayplanPositionGroup::class);
    }
    
    public function positions()
    {
        return $this->hasManyThrough(DayplanPosition::class, Dayplan::class);
    }
    
    public function managerIsNotInvited()
    {
        return is_null($this->invited_at);
    }

    public function managerInvited()
    {
        $this->update([
            'invited_at' => now(),
        ]);
    }
    
    public function details()
    {
        return $this->hasOne(DepartmentDetails::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    
    public function production()
    {
        return $this->belongsTo(Production::class);
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
}
