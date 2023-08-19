<?php

namespace Dayplayer\BackendModels\Helpers;

use Illuminate\Support\Arr;

class AppData
{
    public const ProductionLevelDepartmentType = "Production";
    
    public function ProfessionsHiredDirectlyOnProductionLevel() 
    {
        return [
            'Medic',
            'Production PA',
            'Studio teacher',
            'Studio supervisor',
            'Intimacy coordinator',
        ];
    }
    
    public static function GetPositionsForDepartment($department)
    {
        return Arr::get(self::all(), "department_positions.${department}", []);
    }

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
                'Art',
                'Hair',
                'Grip',
                'Sound',
                'Camera',
                'Costume',
                'Electrical',
                'Hair and make-up',
                self::ProductionLevelDepartmentType,
            ],
            'department_positions' => [
                'Costume' => [
                    "Fitter",
                    "Shopper",
                    "Ager/Dyer",
                    "BG costumer",
                    "Coordinator",
                    "Key Costumer",
                    "Trailer costumer",
                    "Tailor/Seamstress", 
                    "Principal costumer",
                    "Speciality costumer",
                ],
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