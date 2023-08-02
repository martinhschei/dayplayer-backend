<?php

namespace Dayplayer\BackendModels;

use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

class Production extends BaseModel
{
    use DefaultOrderBy;
    
    protected static $orderByColumn = 'start_date';
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
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
