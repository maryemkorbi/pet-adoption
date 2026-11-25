<?php

namespace App\Http\Controllers;

use App\Models\AdoptionRequest;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdoptionRequestController extends Controller
{
    public function store(Request $request, Animal $animal)
    {
        if ($animal->status === 'adopted') {
            return redirect()->route('animals.show', $animal)->with('message', 'This animal has already been adopted.');
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', 'max:100'],
            'phone' => ['required', 'string', 'max:20'],
            'message' => ['nullable', 'string', 'max:500'],
        ]);

        $animal->adoptionRequests()->create($validated);

        $animal->status = 'reserved';
        $animal->save();

        return redirect()->route('animals.show', $animal)->with('message', 'Your adoption request was sent!');
    }

    public function update(Request $request, AdoptionRequest $adoptionRequest)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['accepted', 'refused'])],
        ]);

        $adoptionRequest->status = $validated['status'];
        $adoptionRequest->save();

        $animal = $adoptionRequest->animal;

        if ($validated['status'] === 'accepted') {
            $animal->adoptionRequests()->pending()->update(['status' => 'refused']);
            $animal->status = 'adopted';
        } elseif (! $animal->adoptionRequests()->pending()->exists()) {
            $animal->status = 'available';
        }

        $animal->save();

        return redirect()->route('animals.show', $animal)->with('message', 'Request '.$validated['status'].'.');
    }
}
