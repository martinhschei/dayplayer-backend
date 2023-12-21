<?php

namespace Dayplayer\BackendModels;

use Illuminate\Support\Str;
use Dayplayer\BackendModels\User;
use Dayplayer\BackendModels\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailVerificationCode extends BaseModel
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->token = Str::uuid()->toString();
        });
    }

    public static function createForUser(User $user)
    {        
        $user->emailVerificationCode()->delete();
        
        return EmailVerificationCode::create([
            'user_id' => $user->id,
            'code' => self::createCode(),
        ]);
    }
    
    private static function createCode()
    {
        return rand(1000, 9999);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
