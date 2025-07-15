<?php

use App\Http\Controllers\PizzaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    $pizzas = \App\Models\Pizza::with(['customer', 'status'])->get();

    return Inertia::render('Dashboard', [
        'pizzas' => $pizzas,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('pizzas/{pizza}/advance-status', [PizzaController::class, 'advanceStatus'])
    ->middleware(['auth', 'verified'])
    ->name('pizzas.advanceStatus');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
