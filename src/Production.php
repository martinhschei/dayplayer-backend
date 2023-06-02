<?php

namespace Dayplayer\BackendModels;

use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

class Production extends MongoDbModel
{
    use DefaultOrderBy;
    
    protected static $orderByColumn = 'updated_at';
    protected static $orderByColumnDirection = 'desc';
    
    public function gigs()
    {
        return $this->hasMany(Gig::class);
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
