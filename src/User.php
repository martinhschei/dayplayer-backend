<?php

namespace Dayplayer\BackendModels;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Dayplayer\BackendModels\Profile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $connection = 'mysql';

    const TYPE_DAYPLAYER = 'dayplayer';
    const TYPE_PRODUCTION = 'production';
    const TYPE_INTEGRATION = 'integration';
    
    public $guarded = [];
    public $casts = [
        'email_verified' => 'boolean',
    ];
    
    public static function boot() {
        parent::boot();

        static::creating(function (User $user) {
            $user->email_verification_token = Str::uuid();
        });
    }
    
    public function hasProfile() 
    {
        return ! is_null($this->profile);
    }

    public function profileId()
    {
        return $this->profile->id;
    }
    
    public function getProfileAttribute()
    {
        return $this->hasOne(Profile::class);
    }

    public function createDefaultProfile($firstName, $lastName)
    {
        $profileData = [
            'last_name' => $lastName,
            'first_name' => $firstName,
        ];
        
        $this->profile()->create(array_merge($profileData, [
            'bio' => "",
            'union' => "",
            'birthday' => "",
            'positions' => [],
            'available' => false,
            'phone_number' => "",
            'union_member_since' => "",
        ]));
    }
    
    public function isIntegration(): bool
    {
        return $this->type == self::TYPE_INTEGRATION;
    }

    public function isProduction(): bool
    {
        return $this->type == self::TYPE_PRODUCTION;
    }

    public function isDayplayer(): bool
    {
        return $this->type == self::TYPE_DAYPLAYER;
    }

    public function productions()
    {
        return $this->hasMany(Production::class);
    }
    
    public function uniqueManagers()
    {
        $managers = collect([]);
        
        foreach ($this->productions as $production) {
            foreach ($production->departments as $department) {
                $managers[] = [
                    'name' => $department->manager_name,
                    'email' => $department->manager_email,
                ];
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
