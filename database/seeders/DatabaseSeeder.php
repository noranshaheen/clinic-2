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
        \App\Models\User::factory(10)->create();
        \App\Models\Major::factory(10)->create();
        \App\Models\Doctor::factory(10)->create();
        \App\Models\Booking::factory(10)->create();
        \App\Models\Contact::factory(10)->create();
    }
}
