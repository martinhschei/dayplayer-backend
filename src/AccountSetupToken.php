<?php

namespace Dayplayer\BackendModels;

use Illuminate\Support\Str;
use Dayplayer\BackendModels\User;
use Dayplayer\BackendModels\BaseModel;

class AccountSetupToken extends BaseModel
{
    public static function createForUser(User $user)
    {      
        return AccountSetupToken::create([
            'user_id' => $user->id,
            'value' => Str::uuid()->toString(),
        ]);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
