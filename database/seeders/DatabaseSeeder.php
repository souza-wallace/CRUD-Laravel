<?php

namespace Database\Seeders;
use App\Models\Client;
use App\Models\Address;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Client::factory()->times(10)->create();
        \App\Models\Address::factory()->times(50)->create();
    }
}
