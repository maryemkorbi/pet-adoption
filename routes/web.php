<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('animals.index');
});

Route::resource('animals', AnimalController::class);