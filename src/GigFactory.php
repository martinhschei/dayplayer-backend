<?php

namespace Database\Factories;

use Carbon\Carbon;
use Dayplayer\BackendModels\Production;
use Illuminate\Database\Eloquent\Factories\Factory;

class GigFactory extends Factory
{
    public function definition(): array
    {
        $production = Production::factory()->create();

        return [
            'start_day' => Carbon::now()->format('Y-m-d'),
            'end_day' => Carbon::now()->addDays(3)->format('Y-m-d'),
            'position' => [
                'day_rate' => 25,
                'name' => 'Pulling costumes',
            ],
            'production_id' => $production->id,
        ];
    }
}
