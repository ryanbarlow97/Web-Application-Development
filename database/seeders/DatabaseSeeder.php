<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     * @return void
    */
    public function run() {
        //Call user seeder
        $this->call(UserSeeder::class);
        //Call post seeder
        $this->call(PostSeeder::class);
        //Call like seeder
        $this->call(LikeableSeeder::class);
    }
}
