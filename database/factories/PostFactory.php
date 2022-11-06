<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $created = $this->faker->dateTimeBetween('2010-01-01', '2022-11-05')
            ->format('Y/m/d');

        return [
            //create fake posts inside module area
            'user_id' => $this->faker->unique()->numberBetween(1,50),
            'module_id' => $this->faker->numberBetween(1,12),
            'content' => $this->faker->text(),
            'flair' => $this->faker->text(6),
            'created_at' => $created,
            'updated_at' => $this->faker->dateTimeBetween($created, '2022-11-05')
                ->format('Y/m/d'),
        ];
    }
}
