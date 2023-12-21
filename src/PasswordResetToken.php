<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class PasswordResetToken extends BaseModel
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'email';
    
    public $casts = [
        'used_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function isUsed()
    {
        return ! is_null($this->used_at);
    }

    public function isExpired()
    {
        return $this->updated_at->addMinutes(10)->isPast();
    }
}
