<?php
 
namespace App\Http\Controllers;
 
use App\Models\Post;
use Illuminate\Http\Request;

 
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
            'posts' => Post::findOrFail($id),
            'likes' => Post::findOrFail($id)->likeables()->get(),
        ]);
    }
}