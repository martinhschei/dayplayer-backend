<?php

namespace Database\Factories\Dayplayer\BackendModels;

use Dayplayer\BackendModels\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionFactory extends Factory
{
    public function definition()
    {
        return [
            'area' => 'Los Angeles',
            'department' => 'Hair and make-up',
            'name' => 'The New Big Thing On Netflix',
            'profile_id' => function() { Profile::factory()->create()->id; },
        ];
    }
}
