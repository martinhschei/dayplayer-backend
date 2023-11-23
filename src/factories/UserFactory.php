<?php

namespace Dayplayer\BackendModels\Factories;

use Dayplayer\BackendModels\User;
use Illuminate\Support\Facades\Hash;
use Dayplayer\BackendModels\Helpers\AppData;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{

    protected $model = User::class;
    
    public function definition()
    {
        $type = $this->faker->randomElement(AppData::GetUserTypes());
        $department = $this->faker->randomElement(AppData::GetDepartmentTypes()[$type]);
        
        return [
            'type' => $type,
            'created_at' => now(),
            'updated_at' => now(),
            'department' => $department,
            'email_verified_at' => now(),
            'current_department_id' => null, 
            'current_production_id' => null, 
            'password' => Hash::make('password'),
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date(),
            'first_name' => $this->faker->firstName,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'gender' => $this->faker->randomElement(AppData::GetGenders()), 
        ];
    }
}