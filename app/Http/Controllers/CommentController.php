<?php
 
namespace App\Http\Controllers;
 
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

 
class CommentController extends Controller
{
    public function store(Request $request)
    {
      $validatedData = $request->validate([
        'content' => 'required|max:1000',
        'post_id' => 'required|exists:posts,id',
        'user_id' => 'required|exists:users,id',
      ]);
    
      $comment = new Comment();
      $comment->content = $validatedData['content'];
      $comment->post_id = $validatedData['post_id'];
      $comment->user_id = $validatedData['user_id'];
      $comment->save();
    
        // Redirect back to the page
        return Redirect::back()
        ->with('success', 'Comment successful!');
  }
  
  public function destroy($id)
  {
    $comment = Comment::find($id); 
    if ($comment->user_id == auth()->user()->id) {
           
        $comment->delete();
        return redirect()->back()
            ->with('success', 'Comment deleted successfully');
    } else {
        return redirect()->back()
          ->with('error', 'You do not have permission to delete this comment');
    }
  }
}        
