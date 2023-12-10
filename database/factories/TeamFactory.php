<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'abbreviation' => strtoupper($this->faker->lexify('???')),
            'owner' => function () {
                // Users tablosundan rastgele bir kullanıcı seç
                return User::inRandomOrder()->first()->id;
            },
            'logo' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement([0, 1]),
            'created_at' => now(),
            'updated_at' => now(),
        ];

    }
}
