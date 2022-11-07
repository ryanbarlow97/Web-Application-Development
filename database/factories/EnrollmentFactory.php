<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Module;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EnrollmentFactory extends Factory {
    
    private $enrollmentPairs = [];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {

        //loop to find a unique pair of users/modules
        do {
            $user_id = User::inRandomOrder()->first();
            $module_id = Module::inRandomOrder()->first();
        } while(in_array(array($user_id, $module_id), $this->enrollmentPairs));

        //when a unique pair is found, add it to the *found* pairs array
        array_push($this->enrollmentPairs, array($user_id, $module_id));

        return [
            //create fake enrollment data
            'user_id' => $user_id,
            'module_id' => $module_id,
        ];
    }
}
