<?php
 
namespace App\Http\Controllers;
 
use App\Models\Post;

 
class PostController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('posts.show', [
            'posts' => Post::findOrFail($id)
        ]);
    }
}