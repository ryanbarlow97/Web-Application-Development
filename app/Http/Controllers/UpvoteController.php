<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Likeable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class UpvoteController extends Controller
{
    public function upvote(Request $request)
    {
      // Validate the request data
      $request->validate([
        'likeable_id' => 'required|integer',
        'likeable_type' => 'required|string',
        'user_id' => 'required|integer',
      ]);
    
      // Find the likeable object and user
      $likeable = $request->likeable_type::findOrFail($request->likeable_id);
      $user = \App\Models\User::findOrFail($request->user_id);
    
      // Check if the user has already upvoted the likeable object
      $like = \App\Models\Likeable::where([
        ['likeable_id', $likeable->id],
        ['likeable_type', $request->likeable_type],
        ['user_id', $user->id],
      ])->first();
    
      if ($like) {
        // If the user has already upvoted the likeable object, remove the upvote
        $like = \App\Models\Likeable::where([
            ['likeable_id', $likeable->id],
            ['likeable_type', $request->likeable_type],
            ['user_id', $user->id],
          ])->delete();
        $likes = count($likeable->likeables);
        $upvoted = false;
      } else {
        // If the user has not upvoted the likeable object, add an upvote
        $like = new \App\Models\Likeable();
        $like->likeable_id = $likeable->id;
        $like->likeable_type = $request->likeable_type;
        $like->user_id = $user->id;
        $like->save();
        $likes = count($likeable->likeables);
        $upvoted = true;
      }
    
      // Return a JSON response with the updated number of likes
      return response()->json([
        'likes' => $likes,
        'upvoted' => $upvoted,
      ]);
    }    
}
        
        