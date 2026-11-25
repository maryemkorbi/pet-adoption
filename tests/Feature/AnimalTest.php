<?php

use App\Models\Animal;
use App\Models\Shelter;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('lists the animals', function () {
    $animal = Animal::factory()->create(['name' => 'Simba']);

    $this->get(route('animals.index'))
        ->assertOk()
        ->assertSee('Simba');
});

it('creates an animal with valid data', function () {
    $shelter = Shelter::factory()->create();

    $this->post(route('animals.store'), [
        'shelter_id' => $shelter->id,
        'name' => 'Luna',
        'species' => 'cat',
        'age' => 2,
        'gender' => 'female',
        'vaccinated' => '1',
    ])->assertRedirect();

    $this->assertDatabaseHas('animals', ['name' => 'Luna', 'status' => 'available']);
});

it('refuses an age above 30', function () {
    $shelter = Shelter::factory()->create();

    $this->post(route('animals.store'), [
        'shelter_id' => $shelter->id,
        'name' => 'Old Max',
        'species' => 'dog',
        'age' => 50,
        'gender' => 'male',
    ])->assertSessionHasErrors('age');

    $this->assertDatabaseMissing('animals', ['name' => 'Old Max']);
});

it('returns only available animals as json', function () {
    Animal::factory(3)->create();
    Animal::factory(2)->adopted()->create();

    $this->get(route('animals.json'))
        ->assertOk()
        ->assertJsonCount(3);
});

it('marks the animal as adopted when a request is accepted', function () {
    $animal = Animal::factory()->create();

    $this->post(route('requests.store', $animal), [
        'full_name' => 'Maryem Korbi',
        'email' => 'maryem@example.com',
        'phone' => '+216 12 345 678',
    ]);

    $request = $animal->adoptionRequests()->first();

    $this->patch(route('requests.update', $request), ['status' => 'accepted']);

    expect($animal->fresh()->status)->toBe('adopted');
});
