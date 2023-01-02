<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;

class CommentEdit extends Component
{
    public $commentId;
    public $editMode = 'saveComment';
    public $content;
    public $listeners = ['editComment'];

    public function mount($commentId)
    {
 
        $this->commentId = $commentId;
        $comment = Comment::find($commentId);
        $this->content = $comment->content;
    }

    public function setEdit()
    {
        $this->editMode = 'editComment';
        $this->emit('editing', $this->commentId);
    }

    public function setSave()
    {
        $this->editMode = 'saveComment';
        $this->emit('saved', $this->commentId);
    }

    public function editComment($content)
    {
        $this->content = $content['content'];

        $this->validate([
            'content' => 'required'
            
        ]);

        $comment = Comment::find($this->commentId);
        $comment->content = $this->content;
        $comment->save();

        $this->emit('commentEdited', $this->commentId);
    }
    
    public function render()
    {
        return view('livewire.comment-edit');
    }
}
