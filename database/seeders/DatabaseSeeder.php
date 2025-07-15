<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Always run
        $this->call([
            PizzaStatusSeeder::class,
        ]);

        if (app()->environment('testing')) {
            $this->call([
                UserSeeder::class,
                PizzaClientSeeder::class,
                PizzaSeeder::class,
            ]);
        }
    }
}
