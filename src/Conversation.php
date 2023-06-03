<?php

namespace Dayplayer\BackendModels;

class Conversation extends BaseModel
{
    public function hasParticipant(Profile $profile): bool
    {
        foreach ($this->profiles as $participant) {
            if ($profile->id == $participant->id) {
                return true;
            }
        }

        return false;
    }

    public function messages(): \Illuminate\Database\Eloquent\Relations\HasMany|\Jenssegers\Mongodb\Relations\HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function profiles(): \Jenssegers\Mongodb\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Profile::class);
    }
}
