<?php

namespace Dayplayer\BackendModels\Helpers;

use Illuminate\Support\Arr;
use Dayplayer\BackendModels\Helpers\CountryCodes;

class AppData
{
    public const DayplayerUserType = "dayplayer";
    public const ProductionUserType = "department_head";
    public const ProductionLevelDepartmentType = "Production";

    public static function GetGenders()
    {
        return [
            'male',
            'other',
            'female',
        ];
    }

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
    
    public static function PaymentMethods()
    {
        return [
            'credit_card',
            'monthly_invoice',
            'weekly_invoice',
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

    public static function getDepartmentPositions($department)
    {
        return self::all()['department_positions'][$department] ?? [];
    }

    public static function cities()
    {
        return self::all()['cities'];
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
            'cities' => [
                'Los Angeles',
            ],
            'department_positions' => [
                'Costume' => [
                    "Fitter",
                    "Shopper",
                    "Ager/Dyer",
                    "BG costumer",
                    "Coordinator",
                    "Key costumer",
                    "Set costumer",
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
                'Feature film',
                'Commercial',
                'Episodic',
                'Low budget',
            ],
            'countries' => (new CountryCodes())->list(),
        ];
    }
}