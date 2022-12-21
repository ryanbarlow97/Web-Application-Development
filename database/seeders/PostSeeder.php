<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder {
    /**
     * Run the database seeds.
     * @return void
     */
    public function run() {
        Post::factory(300)->hasComments(rand(1,6))->create();
    }
}
