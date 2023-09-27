<?php

namespace Dayplayer\BackendModels;

use Illuminate\Support\Str;
use Dayplayer\BackendModels\User;
use Dayplayer\BackendModels\BaseModel;

class PasswordSetLink extends BaseModel
{
    public static function createForUser(User $user)
    {
        return self::create([
            'user_id' => $user->id,
            'token' => Str::random(64),
            'expires_at' => now()->addHours(24)
        ]);
    }
    
    public function getLink()
    {
        return route('account-setup', [
            'token' => $this->token,
        ]);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function isExpired()
    {
        return now()->greaterThan($this->expires_at);
    }
}
