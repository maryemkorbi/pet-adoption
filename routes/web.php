<?php

use App\Http\Controllers\AdoptionRequestController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ShelterController;
use App\Models\Animal;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('animals.index');
});

Route::get('/animals.json', function () {
    return Animal::with('shelter')->available()->orderBy('name')->get();
})->name('animals.json');

Route::resource('animals', AnimalController::class);

Route::resource('shelters', ShelterController::class)->only(['index', 'show']);

Route::post('/animals/{animal}/requests', [AdoptionRequestController::class, 'store'])->name('requests.store');
Route::patch('/requests/{adoptionRequest}', [AdoptionRequestController::class, 'update'])->name('requests.update');
