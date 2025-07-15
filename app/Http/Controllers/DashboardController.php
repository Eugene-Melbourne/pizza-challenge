<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $pizzas = Pizza::with(['customer', 'status'])->get();

        return Inertia::render('Dashboard', [
            'pizzas' => $pizzas,
        ]);
    }
}
