<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'phone' => $this->faker->phoneNumber,
            'gender' => $this->faker->randomElement([0, 1]),
            'birthdate' => $this->faker->date,
            'username' => $this->faker->unique()->userName,
            'discord' => $this->faker->userName . '#'. $this->faker->randomNumber(4),
            'email_verification' => $this->faker->randomElement([0, 1, null]),
            'discord_verification' => $this->faker->randomElement([0, 1, null]),
            'gender_verification' => $this->faker->randomElement([0, 1, null]),
            'is_admin' => $this->faker->randomElement([0, 1]),
            'status' => $this->faker->randomElement([0, 1]),
            'created_at' => now(),
            'updated_at' => now(),
        ];

    }
}