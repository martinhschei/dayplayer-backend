<?php

namespace Dayplayer\BackendModels;

use Cviebrock\EloquentSluggable\Sluggable;
use Dayplayer\BackendModels\ProductionBillingDetails;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Production extends BaseModel
{
    use Sluggable;
    use SluggableScopeHelpers;
    
    public $with = ['billingDetails'];

    public function sluggable(): array 
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }
    
    public function billingDetails()
    {   
        return $this->hasOne(ProductionBillingDetails::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function admin()
    {   
        return $this->hasOne(User::class, 'user_id');
    }

    public function getProductNameAttribute()
    {
        return "{$this->name} // {$this->start_date}-{$this->end_date}";
    }
}
