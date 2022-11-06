<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Module;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EnrollmentFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            //create fake enrollment data
            'user_id' => $this->faker->numberBetween(1,50),
            'module_id' => $this->faker->numberBetween(1,12),
        ];
    }
}
