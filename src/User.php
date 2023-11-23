<?php

namespace Dayplayer\BackendModels;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Dayplayer\BackendModels\Profile;
use Illuminate\Notifications\Notifiable;
use Dayplayer\BackendModels\Helpers\AppData;
use Dayplayer\BackendModels\EmailVerificationCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    public $guarded = [];

    public $hidden = ['password'];
    
    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }
    
    public function getIsProductionLevelAttribute()
    {
        return $this->profile->department_affiliation == AppData::ProductionLevelDepartmentType && $this->isProduction();
    }

    public function routeNotificationForApn()
    {
        return [$this->device_token];
    }

    public function hasProfile() 
    {
        return ! is_null($this->profile);
    }
    
    public function availabilitySettings()
    {
        return $this->hasOne(AvailabilitySettings::class);
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class);
    }
    
    public function productions()
    {
        return $this->hasMany(Production::class);
    }
    
    public function currentDepartment()
    {
        if (is_null($this->current_department_id)) {
            return null;
        }
        
        return $this->departmentLevelProductions()->whereHas('departments', function ($query) {
            $query->where('id', $this->current_department_id);
        })->first()->departments->first();
    }
    
    public function departmentLevelProductions()
    {
        return Production::whereHas('departments', function ($query) {
            $query->where('manager_id', $this->id);
        })->with(['departments' => function ($query) {
            $query->where('manager_id', $this->id);
        }]);
    }
    
    public function allProductions()
    {
        $productionsQuery = $this->productions()->getQuery();

        return $productionsQuery->union($this->departmentLevelProductions());
    }
    
    public function getProduction($id)
    {
        return $this->departmentLevelProductions()->where('id', $id)->first() ?? $this->productions()->where('id', $id)->first();
    }

    public function profileId()
    {
        return $this->profile->id;
    }
    
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    
    public function managedDepartments()
    {
        return $this->hasMany(Department::class, 'manager_id');
    }
    
    public function emailVerificationCode()
    {
        return $this->hasOne(EmailVerificationCode::class);
    }
    
    public function createDefaultProfile($values = [])
    {
        $defaultValues = array_merge([
            'birthday' => now()->format('Y-m-d'),
            'union_member_since' => now()->format('Y-m-d'),
        ], $values);
        
        $this->profile()->create($defaultValues);
    }
    
    public function isProduction(): bool
    {
        return $this->type == AppData::ProductionUserType;
    }
        
    public function isDayplayer(): bool
    {
        return $this->type == AppData::DayplayerUserType;
    }

    public function uniqueManagers()
    {
        $managers = collect([]);
        
        foreach ($this->productions as $production) {
            foreach ($production->departments as $department) {
                $managers[] = $department->manager_email;
            }
        }
        
        return $managers->unique();
    }
    
    public function uniqueDepartmentNames()
    {
        $departmens = collect([]);
        
        foreach ($this->productions as $production) {
            foreach ($production->departments as $department) {
                $departmens[] = $department->name;
            }
        }

        return $departmens->unique();
    }
}
