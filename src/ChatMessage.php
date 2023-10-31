<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class ChatMessage extends BaseModel
{
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
    
    public function sender()
    {
        return $this->belongsTo(Profile::class);
    }
}