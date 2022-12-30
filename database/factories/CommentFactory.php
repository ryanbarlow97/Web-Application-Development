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

        $first_user = User::inRandomOrder()->first();

        $created = $this->faker->dateTimeBetween('2021-01-02', now())
            ->format('Y/m/d');
        $updated = $created;

        return [
            //create fake posts inside module area
            'user_id' => $first_user->id,
            'content' => $this->faker->text(),
            'created_at' => $created,
            'updated_at' => $updated,
            ];
    }
}
