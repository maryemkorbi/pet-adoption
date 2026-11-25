<?php

namespace Database\Seeders;

use App\Models\AdoptionRequest;
use App\Models\Animal;
use App\Models\Shelter;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $shelters = Shelter::factory(4)->create();

        Animal::factory(20)->create(fn () => ['shelter_id' => $shelters->random()->id]);
        Animal::factory(5)->adopted()->create(fn () => ['shelter_id' => $shelters->random()->id]);

        Animal::available()->inRandomOrder()->take(4)->get()->each(function (Animal $animal) {
            AdoptionRequest::factory()->create(['animal_id' => $animal->id]);

            $animal->status = 'reserved';
            $animal->save();
        });
    }
}
