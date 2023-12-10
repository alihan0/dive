<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Team;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=TeamMember>
 */
class TeamMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team' => function () {
                // Users tablosundan rastgele bir kullanıcı seç
                return Team::inRandomOrder()->first()->id;
            },
            'user' => function () {
                // Users tablosundan rastgele bir kullanıcı seç
                return User::inRandomOrder()->first()->id;
            },
            'role' => $this->faker->randomElement([1, 2, 3]), // Adjust role values as needed
            'status' => $this->faker->randomElement([0, 1]),
            'created_at' => now(),
            'updated_at' => now(),
        ];

    }
}
