<?php

namespace Dayplayer\BackendModels;

class Production extends BaseModel
{   
    public $casts = [
        'end_date' => 'date',
        'start_date' => 'date',
    ];
    
    public static function productionTypeDisplayNames()
    {
        return [
            'episodic' => 'Episodic',
            'commercial' => 'Commercial',
            'low_budget' => 'Low budget',
            'feature_film' => 'Feature film',
        ];
    }

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
