<?php

namespace App\Http\Controllers;

use App\Models\Shelter;

class ShelterController extends Controller
{
    public function index()
    {
        return view('shelters.index', [
            'shelters' => Shelter::withCount('animals')->orderBy('name')->get(),
        ]);
    }

    public function show(Shelter $shelter)
    {
        return view('shelters.show', [
            'shelter' => $shelter,
            'animals' => $shelter->animals()->latest()->get(),
        ]);
    }
}
