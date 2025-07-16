<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Pizza;
use App\Models\PizzaStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pizza>
 */
class PizzaFactory extends Factory
{
    protected $model = Pizza::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'status_id' => PizzaStatus::getByKey(PizzaStatus::KEY_STARTED)->id,
            'status_set_at' => $this->faker->dateTime,
        ];
    }
}
