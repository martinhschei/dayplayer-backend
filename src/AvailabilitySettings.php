<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class AvailabilitySettings extends BaseModel
{
    public $casts = [
        'available' => 'boolean',
        'notify_by_sms' => 'boolean',
        'notify_by_email' => 'boolean',
        'notify_on_new_offers' => 'boolean',
        'notify_on_offer_updates' => 'boolean',
        'notify_on_new_chat_messages' => 'boolean',
    ];
}
