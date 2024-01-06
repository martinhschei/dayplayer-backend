<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class NotificationSettings extends BaseModel
{
    public $casts = [
        'notify_by_sms' => 'boolean',
        'notify_by_email' => 'boolean',
        'notify_on_booking_updates' => 'boolean',
        'notify_on_payment_updates' => 'boolean',
        'notify_on_job_offer_updates' => 'boolean',
        'notify_on_new_chat_messages' => 'boolean',
    ];
}
