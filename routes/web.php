<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;

// Página de inicio (dashboard)
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// CRUD de registros
Route::resource('registros', RegistroController::class);