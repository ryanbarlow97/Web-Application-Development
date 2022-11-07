<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $created = $this->faker->dateTimeBetween('2010-01-01', '2022-11-05')
        ->format('Y/m/d');
        $updated = $this->faker->dateTimeBetween($created, '2022-11-05')
        ->format('Y/m/d');

        $first_post= Post::inRandomOrder()->first();
        $first_user = $first_post->module->users->random()->users;



        return [
            //create fake posts inside module area
            'user_id' => $first_user,
            'post_id' => $first_post,
            'content' => $this->faker->text(),
            'created_at' => $created,
            'updated_at' => $updated,
            ];
    }
}
