<?php

namespace Database\Factories;

use App\Models\Shelter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shelter>
 */
class ShelterFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'SPA Tunis',
                'Paws of Carthage',
                'Sousse Animal Rescue',
                'Sfax Happy Tails',
                'Bizerte Pet Haven',
                'Nabeul Animal Home',
            ]),
            'city' => fake()->randomElement(['Tunis', 'Sousse', 'Sfax', 'Bizerte', 'Nabeul', 'Monastir']),
            'phone' => fake()->numerify('+216 ## ### ###'),
            'email' => fake()->safeEmail(),
        ];
    }
}