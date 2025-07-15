<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Pizza;
use App\Models\PizzaStatus;
use Illuminate\Database\Seeder;

class PizzaSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();
        $statuses = PizzaStatus::all();
        for ($i = 0; $i < 20; $i++) {
            $customer = $customers->random();
            $status = $statuses->random();
            Pizza::create([
                'customer_id' => $customer->id,
                'status_id' => $status->id,
                'status_set_at' => now()->subMinutes(rand(1, 120)),
            ]);
        }
    }
}
