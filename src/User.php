<?php

namespace Dayplayer\BackendModels;

use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Dayplayer\BackendModels\Profile;
use Illuminate\Notifications\Notifiable;
use Dayplayer\BackendModels\Helpers\AppData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;
    
    public $appends = [
        'is_production_level',
    ];
    
    public $guarded = [];
    public $with = ['profile'];
    
    public $casts = [
        'email_verified' => 'boolean',
    ];
    
    public static function boot() {
        parent::boot();

        static::creating(function (User $user) {
            $user->email_verification_token = Str::uuid();
        });
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

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class);
    }
    
    public function productions()
    {
        return $this->hasMany(Production::class);
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

    public function hasVerifiedEmail(): bool
    {
        return $this->email_verified === true;
    }

    public function emailVerified()
    {
        $this->update([
            'email_verified' => true,
        ]);
    }
}
