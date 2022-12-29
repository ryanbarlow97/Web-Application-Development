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

        $first_post= Post::inRandomOrder()->first();
        $first_user = $first_post->module->users->random()->users;

        $created = $this->faker->dateTimeBetween($first_post->created_at, now())
            ->format('Y/m/d');
        $updated = $created;

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
