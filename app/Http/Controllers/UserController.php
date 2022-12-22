<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;

 
class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('users.show', [
            'users' => User::findOrFail($id)
        ]);
    }

    public function posts($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts;

        return view('users.posts', compact('user', 'posts'));
    }

    public function comments($id)
    {
        $user = User::findOrFail($id);
        $comments = $user->comments;

        return view('users.comments', compact('user', 'comments'));
    }

    public function likedPosts($id)
    {
        $user = User::findOrFail($id);
        $likedPosts = $user->likedPosts;

        return view('users.liked-posts', compact('user', 'likedPosts'));
    }

    public function likedComments($id)
    {
        $user = User::findOrFail($id);
        $likedComments = $user->likedComments;

        return view('users.liked-comments', compact('user', 'likedComments'));
    }

}