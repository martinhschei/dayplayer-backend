<?php

namespace Dayplayer\BackendModels\Helpers;

class AppData
{
    public static function GetProductionTypes()
    {
        return self::all()['production_types'];
    }
    
    public static function GetUserTypes()
    {
        return self::all()['user_types'];
    }

    public static function GetDepartmentTypes()
    {
        return self::all()['department_types'];
    }
    
    public static function all()
    {
        return [
            'user_types' => [
                'production',
                'dayplayer',
            ],
            'department_types' => [
                'Costumes',
                'Catering',
                'Production',
                'Hair and make-up',
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