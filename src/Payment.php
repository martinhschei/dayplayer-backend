<?php

namespace Dayplayer\BackendModels;

class Payment extends BaseModel
{
    public const PAYMENT_STATUS_PAID = 'paid';
    public const PAYMENT_STATUS_PENDING = 'pending';   
    public const PAYMENT_STATUS_OVERDUE = 'overdue';
    
    public const PAYMENT_METHOD_WEEKLY = 'weekly';
    public const PAYMENT_METHOD_MONTHLY = 'monthly';
    public const PAYMENT_METHOD_CREDIT_CARD = 'credit_card';

    public function production()
    {
        return $this->belongsTo(Production::class);
    }
}
