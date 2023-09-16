<?php

namespace Dayplayer\BackendModels\Helpers;

use Illuminate\Support\Arr;

class AppData
{
    public const DayplayerUserType = "dayplayer";
    public const ProductionUserType = "department_head";
    public const ProductionLevelDepartmentType = "Production";

    public static function ProfessionsHiredDirectlyOnProductionLevel() 
    {
        return [
            'Medic',
            'Production PA',
            'Studio teacher',
            'Script supervisor',
            'Intimacy coordinator',
        ];
    }
    
    public static function GetPositionsForDepartment($department)
    {
        return Arr::get(self::all(), "department_positions.{$department}", []);
    }

    public static function GetProductionTypes()
    {
        return self::all()['production_types'];
    }
    
    public static function GetUserTypes()
    {
        return [
            self::DayplayerUserType,
            self::ProductionUserType,
        ];
    }

    public static function GetDepartmentTypes()
    {
        return self::all()['department_types'];
    }

    public static function GetAllDepartmentTypes()
    {
        return self::all()['department_types']['production'];
    }

    public static function GetBaseDepartments()
    {
        return [
            'Art',
            'Hair',
            'Grip',
            'Sound',
            'Make-up',
            'Camera',
            'Costume',
            'Electrical',
            self::ProductionLevelDepartmentType,
        ];
    }

    private static function order(&$array) {
        usort($array, function($a, $b) {
            return strlen($a) - strlen($b);
        });
    }

    public static function all()
    {
        $userTypes = self::GetUserTypes();
        self::order($userTypes);
        
        $productionDepartments = self::GetBaseDepartments();
        self::order($productionDepartments);
        
        $hiredDirectlyOnProductionLevel = self::ProfessionsHiredDirectlyOnProductionLevel();
        $dayplayerDepartments = array_merge($productionDepartments, $hiredDirectlyOnProductionLevel);
        self::order($dayplayerDepartments);

        return [
            'user_types' => $userTypes,
            'department_types' => [
                'dayplayer' => $dayplayerDepartments,
                'department_head' => $productionDepartments,
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
        ];
    }
}