<?php

namespace Database\Factories;

use App\Models\AdoptionRequest;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AdoptionRequest>
 */
class AdoptionRequestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'animal_id' => Animal::factory(),
            'full_name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->numerify('+216 ## ### ###'),
            'message' => fake()->sentence(10),
        ];
    }
}
