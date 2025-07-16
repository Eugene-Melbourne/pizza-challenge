<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PizzaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('pizzas/{pizza}/advance-status', [PizzaController::class, 'advanceStatus'])
    ->middleware(['auth', 'verified'])
    ->name('pizzas.advanceStatus');

Route::view('/docs/pizza-status', 'docs.pizza-status');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
