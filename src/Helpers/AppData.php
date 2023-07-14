<?php

namespace Dayplayer\BackendModels\Helpers;

class AppData
{
    public static function GetUserTypes()
    {
        return self::all()['user_types'];
    }
    
    public static function all()
    {
        return [
            'user_types' => [
                'production',
                'dayplayer',
            ],
            'department_types' => [
                'Hair and make-up',
                'Costumes',
                'Food and drinks',
            ],
            'union_types' => [
                '705',
                '892',
            ],
            'production_types' => [
                'Episodic',
                'Commercial',
                'Low budget',
                'Feature film',
            ],
            'position_types' => [
                'PA',
                'Shopper',
                'Pulling props',
                'Pulling costumes', 
            ],
        ];
    }
}