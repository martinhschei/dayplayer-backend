<?php

namespace Dayplayer\BackendModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Dayplayer\BackendModels\User;
use Illuminate\Support\Facades\Hash;
use Dayplayer\BackendModels\DepartmentJob;
use Dayplayer\BackendModels\Helpers\AppData;

class Department extends BaseModel
{
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

    public function isManagerInvited()
    {
        return ! is_null($this->invited_at);
    }

    public function managerInvited()
    {
        $this->update([
            'invited_at' => now(),
        ]);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    
    public function createDepartmentHeadUser(): User
    {
        $user = User::create([
            'type' => AppData::ProductionUserType,
            'password' => Hash::make(Str::random(40)),
            'name' => strtolower($this->manager_email),
            'email' => strtolower($this->manager_email),
        ]);

        $user->createDefaultProfile([
            'department_affiliation' => $this->name,
            'birthday' => Carbon::createFromFormat('Y-m-d H:i:s', '1900-01-01 00:00:00'),
        ]);

        return $user;
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
