<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class PizzaClientSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Alice', 'Bob', 'Charlie', 'Diana', 'Eve', 'Frank', 'Grace', 'Heidi', 'Ivan', 'Judy',
        ];
        foreach ($names as $name) {
            Customer::create(['name' => $name]);
        }
    }
}
