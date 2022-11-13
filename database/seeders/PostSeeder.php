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
        $randomnum = rand(0,1);

        if ($randomnum == 0) {
            Post::factory(300)->create();
        } if ($randomnum == 1) {
            Post::factory(300)->hasComments(rand(1,6))->create();
        }
    }
}
