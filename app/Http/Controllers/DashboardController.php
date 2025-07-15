<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Inertia\Inertia;
use App\Models\Pizza;

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
