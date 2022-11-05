<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        //Call to User seeder
        $this->call(UserSeeder::class);
        //Call to module seeder
        $this->call(ModuleSeeder::class);
    }
}
