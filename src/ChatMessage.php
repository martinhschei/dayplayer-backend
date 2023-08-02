<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class ChatMessage extends BaseModel
{
    public function sentByMe()
    {
        return auth()->id() === $this->sender_id;
    }
}