<?php

namespace Dayplayer\BackendModels;

class Conversation extends BaseModel
{
    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
    
    public function participants()
    {
        return $this->belongsToMany(User::class);
    }
}
