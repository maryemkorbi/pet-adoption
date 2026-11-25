<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\Shelter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Animal>
 */
class AnimalFactory extends Factory
{
    public function definition(): array
    {
        $species = fake()->randomElement(Animal::SPECIES);

        $breeds = [
            'cat' => ['European', 'Siamese', 'Persian'],
            'dog' => ['Mixed', 'Labrador', 'German Shepherd'],
            'rabbit' => ['Dwarf', 'Lop'],
            'bird' => ['Canary', 'Parrot'],
            'other' => ['Unknown'],
        ];

        return [
            'shelter_id' => Shelter::factory(),
            'name' => fake()->randomElement([
                'Milo', 'Luna', 'Simba', 'Nala', 'Rocky', 'Bella', 'Oscar', 'Lola',
                'Max', 'Kiki', 'Zizou', 'Mimi', 'Choco', 'Snow', 'Tiger', 'Pepper',
            ]),
            'species' => $species,
            'breed' => fake()->randomElement($breeds[$species]),
            'age' => fake()->numberBetween(0, 15),
            'gender' => fake()->randomElement(Animal::GENDERS),
            'description' => fake()->sentence(12),
            'vaccinated' => fake()->boolean(70),
        ];
    }

    public function adopted(): static
    {
        return $this->state(['status' => 'adopted']);
    }
}