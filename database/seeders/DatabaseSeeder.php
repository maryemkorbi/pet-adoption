<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Shelter;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $shelters = Shelter::factory(4)->create();

        Animal::factory(20)->create(fn () => ['shelter_id' => $shelters->random()->id]);
        Animal::factory(5)->adopted()->create(fn () => ['shelter_id' => $shelters->random()->id]);
    }
}
