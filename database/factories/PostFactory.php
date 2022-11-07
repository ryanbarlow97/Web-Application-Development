<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;
use App\Models\Module;

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
        $created = $this->faker->dateTimeBetween('2010-01-01', '2022-11-05')
            ->format('Y/m/d');
        $updated = $this->faker->dateTimeBetween($created, '2022-11-05')
            ->format('Y/m/d');

        $first_module = Module::inRandomOrder()->first();
        $first_user = $first_module->users->random()->users;

        return [
            //create fake posts inside module area
            'user_id' => $first_user,
            'module_id' => $first_module,
            'content' => $this->faker->text(),
            'flair' => $this->faker->text(6),
            'created_at' => $created,
            'updated_at' => $updated,
        ];
    }
}
