<?php

namespace Database\Seeders;

use App\Models\PizzaStatus;
use Illuminate\Database\Seeder;

class PizzaStatusSeeder extends Seeder
{
    public function run(): void
    {
        PizzaStatus::insert([
            ['key' => 'order_placed'],
            ['key' => 'started'],
            ['key' => 'in_oven'],
            ['key' => 'ready'],
            ['key' => 'dispatched'],
        ]);
    }
}
