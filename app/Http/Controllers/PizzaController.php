<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\PizzaStatus;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PizzaController extends Controller
{
    public function advanceStatus(Request $request, Pizza $pizza): RedirectResponse
    {
        if (! $pizza->status->isLastStatus()) {
            $newKey = PizzaStatus::getNextStatusKey($pizza->status->key);
            $pizza->status()->associate(PizzaStatus::getByKey($newKey));
            $pizza->status_set_at = Carbon::now();
            $pizza->save();
            $typeKey = 'success';
            $message = 'Pizza status advanced successfully';
        } else {
            $typeKey = 'info';
            $message = 'Pizza is already dispatched.';
        }

        return Redirect::back()->with($typeKey, $message);
    }
}
