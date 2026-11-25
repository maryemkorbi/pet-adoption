<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $animals = Animal::with('shelter')
            ->ofSpecies($request->query('species'))
            ->search($request->query('search'))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('animals.index', [
            'animals' => $animals,
            'species' => Animal::SPECIES,
            'availableCount' => Animal::available()->count(),
        ]);
    }

    public function show(Animal $animal)
    {
        $animal->load(['shelter', 'adoptionRequests' => fn ($query) => $query->latest()]);

        return view('animals.show', ['animal' => $animal]);
    }

    public function create()
    {
        return view('animals.create', [
            'animal' => new Animal(),
            'shelters' => Shelter::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateAnimal($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('animals', 'public');
        }

        $animal = Animal::create($validated);

        return redirect()->route('animals.show', $animal)->with('message', 'Animal added.');
    }

    public function edit(Animal $animal)
    {
        return view('animals.edit', [
            'animal' => $animal,
            'shelters' => Shelter::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Animal $animal)
    {
        $validated = $this->validateAnimal($request);

        if ($request->hasFile('photo')) {
            if ($animal->photo) {
                Storage::disk('public')->delete($animal->photo);
            }
            $validated['photo'] = $request->file('photo')->store('animals', 'public');
        }

        $animal->update($validated);

        return redirect()->route('animals.show', $animal)->with('message', 'Animal updated.');
    }

    public function destroy(Animal $animal)
    {
        if ($animal->photo) {
            Storage::disk('public')->delete($animal->photo);
        }

        $animal->delete();

        return redirect()->route('animals.index')->with('message', 'Animal removed.');
    }

    private function validateAnimal(Request $request): array
    {
        return $request->validate([
            'shelter_id' => ['required', 'exists:shelters,id'],
            'name' => ['required', 'string', 'max:50'],
            'species' => ['required', Rule::in(Animal::SPECIES)],
            'breed' => ['nullable', 'string', 'max:50'],
            'age' => ['required', 'integer', 'between:0,30'],
            'gender' => ['required', Rule::in(Animal::GENDERS)],
            'description' => ['nullable', 'string', 'max:1000'],
            'vaccinated' => ['boolean'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ], [], [
            'shelter_id' => 'shelter',
        ]);
    }
}
