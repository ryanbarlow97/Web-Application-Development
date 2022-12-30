<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeableFactory extends Factory {


    private $likePairs = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {


        // Loop to find a unique pair of users/modules
        do {
            // Either like the post or a random comment inside the post
            if (rand(0, 1) == 1) {
                //find a random post.
                $random_post = Post::inRandomOrder()->first();
                $random_user = User::inRandomOrder()->first();

                // Find a user ID from the module which is linked to that post
                $user_id = $random_user->id;
                $likeable_id = $random_post->id;
                $likeable_type = get_class($random_post);
            } else {
                //find random comment.
                $random_comment = Comment::inRandomOrder()->first();     
                $random_user = User::inRandomOrder()->first();

                // Find a user ID from the module which is linked to that comment
                $user_id = $random_user->id;
                $likeable_id = $random_comment->id;
                $likeable_type = get_class($random_comment);
            }

            // Check if the combination of $user_id and $likeable_id exists in the $this->likePairs array
            $pair_exists = false;
            foreach ($this->likePairs as $pair) {
                if ($pair[0] == $user_id && $pair[1] == $likeable_id) {
                    $pair_exists = true;
                    break;
                }
            }
        } while ($pair_exists);


        //when a unique pair is found, add it to the *found* pairs array
        array_push($this->likePairs, array($user_id, $likeable_id));


        return [
            'user_id' => $user_id,
            'likeable_id' => $likeable_id,
            'likeable_type' => $likeable_type,
        ];        
    }
}