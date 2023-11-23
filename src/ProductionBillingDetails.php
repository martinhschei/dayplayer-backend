<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\BaseModel;

class ProductionBillingDetails extends BaseModel
{
    public $with = ['payments'];
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
