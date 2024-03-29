<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Likeable;

class LikeableSeeder extends Seeder {
    /**
     * Run the database seeds.
     * @return void
     */
    public function run() {
        Likeable::factory(5000)->create();
    }
}
