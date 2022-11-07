<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Module;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory {
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
        
        $permitted_chars ='ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return [
            //create fake module
            //fake module name/number e.g. AB123
            'name' => substr(str_shuffle($permitted_chars), 0 , 2) . rand(100,399),
            'description' => $this->faker->text(),
            'module_logo' => Str::random(12) . '.png',
            'created_at' => $created,
            'updated_at' => $updated,
        ];
    }
}
