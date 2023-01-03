<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
 
        $created = $this->faker->dateTimeBetween('2015-01-01', '2022-11-05')
            ->format('Y/m/d');
        $updated = $this->faker->dateTimeBetween($created, '2022-11-05')
            ->format('Y/m/d');

        return [
            //create fake user
            'user_name' => $this->faker->userName(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'date_of_birth' => $this->faker->dateTimeBetween('1970-01-01', '2003-12-31')
                ->format('Y/m/d'),
            'email' => $this->faker->unique()->safeEmail(),
            #'email_verified_at' => now(),
            #'mobile' => $this->faker->phoneNumber(),
            'password' => hash('sha512', $this->faker->name()),
            'remember_token' => Str::random(12),
            'created_at' => $created,
            'updated_at' => $updated,
        ];
    }
}
