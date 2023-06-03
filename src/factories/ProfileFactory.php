<?php

namespace Database\Factories;

use Dayplayer\BackendModels\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'union' => '908',
            'available' => true,
            'first_name' => 'Mike',
            'last_name' => 'Hansen',
            'union_member_years' => 3,
            'identifies_as' => 'male',
            'gender_at_birth' => 'male',
            'positions' => ['shopper', 'dressing', 'gaffer'],
            'birthday' => now()->subYears(31)->format('Y-m-d'),
            'user_id' => function() { return User::factory()->create()->id; },
        ];
    }
}
