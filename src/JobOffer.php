<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class JobOffer extends BaseModel
{
    public $with = ['sender', 'offerable'];
    
    public $appends = [
        'end',
        'start',
        'duration'
    ];
    
    public $casts = [
        'expires_at' => 'datetime',
        'declined_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];
    
    const STATE_SENT = 'sent';
    const STATE_VIEWED = 'viewed';
    const STATE_REVOKED = 'revoked';
    const STATE_EXPIRED = 'expired';
    const STATE_CREATED = 'created';
    const STATE_ACCEPTED = 'accepted';
    const STATE_DECLINED = 'declined';

    public function isOpen()
    {
        return $this->state === JobOffer::STATE_SENT || 
               $this->state === JobOffer::STATE_CREATED ||
               $this->state === JobOffer::STATE_ACCEPTED ||
               $this->state === JobOffer::STATE_VIEWED;
    }
    
    public function isClosed()
    {
        return $this->state === JobOffer::STATE_EXPIRED || 
               $this->state === JobOffer::STATE_REVOKED || 
               $this->state === JobOffer::STATE_DECLINED;
    }

    public function offerable()
    {
        return $this->morphTo();
    }

    public function hasBeenAccepted()
    {
        return $this->state === JobOffer::STATE_ACCEPTED;
    }   

    public function markAsDeclined()
    {
        $this->update([
            'declined_at' => now(),
            'state' => JobOffer::STATE_DECLINED,
        ]);
    }

    public function markAsAccepted()
    {
        $this->update([
            'accepted_at' => now(),
            'state' => JobOffer::STATE_ACCEPTED,
        ]);
    }

    public function markAsViewed()
    {
        $this->update([
            'state' => JobOffer::STATE_VIEWED,
        ]);
    }

    public function sent()
    {
        $this->update([
            'state' => JobOffer::STATE_SENT,
        ]);
    }

    public function getHasExpiredAttribute()
    {
        return $this->expires_at ? $this->expires_at->isPast() : false;
    }

    public function expiresAt()
    {
        return $this->expires_at;
    }

    public function sender()
    {
        return $this->belongsTo(User::class);
    }
    
    public function receiver()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getEndAttribute()
    {
        return $this->offerable->end;
    }

    public function getStartAttribute()
    {
        return $this->offerable->start;
    }  
    
    public function getDurationAttribute()
    {
        return $this->offerable->duration;
    }
}