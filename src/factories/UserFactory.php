<?php

namespace Database\Factories\Dayplayer\BackendModels;

use Illuminate\Support\Str;
use Dayplayer\BackendModels\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'email_verified' => false,
            'type' => User::TYPE_DAYPLAYER,
            'email' => fake()->unique()->safeEmail(),
            'email_verification_token' => Str::uuid(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}
