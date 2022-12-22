<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Likeable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class UpvoteController extends Controller
{
    public function upvote(Request $request)
    {
        // Validate the request and extract the post ID and user ID
        $validatedData = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $postId = $validatedData['post_id'];
        $userId = $validatedData['user_id'];

        // Check if the user has already upvoted the post
        $post = Post::findOrFail($postId);
        $like = Likeable::where([
            ['likeable_id', $postId],
            ['likeable_type', 'App\Models\Post'],
            ['user_id', $userId],
        ])->first();

        if ($like) {
            // If the user has already upvoted the post, delete the like
            Likeable::where([
                ['likeable_id', $postId],
                ['likeable_type', 'App\Models\Post'],
                ['user_id', $userId],
            ])->delete();
            
        } else {
            // Create a new upvote record
            Likeable::create([
                'user_id' => $userId,
                'likeable_id' => $postId,
                'likeable_type' => 'App\Models\Post',
            ]);
        }

        // Get the current number of likes for the post
        $likeCount = $post->likeables()->count();


        // Redirect back to the page
        return Redirect::back()
        ->with('success', 'Upvote successful!')
        ->with('likeCount', $likeCount);
    }
}
        
        