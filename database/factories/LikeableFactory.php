<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {

        if(rand(0,1) == 1) {
            $like_type = 'App\\Models\\Post';
        } else {
            $like_type = 'App\\Models\\Comment';
        }

        return [
            'user_id' => $this->faker->numberBetween(1,50),
            'likeable_id' => $this->faker->numberBetween(1,50),
            'likeable_type' => $like_type,
        ];        
    }
}
