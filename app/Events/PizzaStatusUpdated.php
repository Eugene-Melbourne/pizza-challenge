<?php

namespace App\Events;

use App\Models\Pizza;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PizzaStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Pizza $pizza;

    /**
     * @return void
     */
    public function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza->withoutRelations();
    }
}
