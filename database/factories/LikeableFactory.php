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
    private $random_post;
    private $random_comment;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {

        //find a random post.
        $random_post = Post::inRandomOrder()->first();
        //find random comment.
        $random_comment = Comment::inRandomOrder()->first();     

        //loop to find a unique pair of users/modules
        do {           
            //either like the post or a random comment inside the post
            if(rand(0,1) == 1) {
                //find a userID from the module which is linked to that post
                $user_id = $random_post->module->users->random()->users;
                $likeable_id = $random_post;
            } else {
                //find a userID from the module which is linked to that comment
                $user_id = $random_comment->post->module->users->random()->users;
                $likeable_id = $random_comment;
            }
        } while(in_array(array($user_id, $likeable_id), $this->likePairs));

        //when a unique pair is found, add it to the *found* pairs array
        array_push($this->likePairs, array($user_id, $likeable_id));

        $likeable_type = get_class($likeable_id);

        return [
            'user_id' => $user_id,
            'likeable_id' => $likeable_id->id,
            'likeable_type' => $likeable_type,
        ];        
    }
}