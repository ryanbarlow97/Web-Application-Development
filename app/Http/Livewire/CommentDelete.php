<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentDelete extends Component
{
    public $commentId;

    public function mount($commentId)
    {
        $this->commentId = $commentId;

    }

    public function deleteComment()
    {
        $comment = Comment::find($this->commentId);
        $comment->delete();

        //remove the notification
        DB::table('notifications')
        ->where('data->type', 'comment')
        ->where('data->content_id', $this->commentId)
        ->delete();

        $this->emit('commentDeleted', $this->commentId);
    }

    public function render()
    {
        return view('livewire.comment-delete', [
            'commentId' => $this->commentId,
        ]);
    }        
}
