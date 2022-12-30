<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $created = $this->faker->dateTimeBetween('2020-01-01', '2021-01-01')
            ->format('Y/m/d');
        $updated = $created;

        $first_user = User::inRandomOrder()->first();

        return [
            //create fake posts inside module area
            'user_id' => $first_user->id,
            'content' => $this->faker->text(),
            'flair' => $this->faker->text(6),
            'created_at' => $created,
            'updated_at' => $updated,
        ];
    }
}
