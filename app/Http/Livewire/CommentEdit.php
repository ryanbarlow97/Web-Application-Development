<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Str;


class CommentEdit extends Component
{
    // properties to hold the comment data
    public $commentId;
    public $origContent;
    public $newContent;

    // validation rules
    protected $rules = [
        'newContent' => 'required|string'
    ];

    /**
     * Initialize the component by setting the comment data and
     * re-initializing the component state.
     * 
     * @param Comment $comment
     * @return void
     */
    public function mount(Comment $comment)
    {
        $this->commentId = $comment->id;
        $this->origContent = $comment->content;

        $this->init($comment);
    }

    /**
     * Save the edited comment to the database.
     * 
     * @return void
     */
    public function save()
    {
        // validate form input
        $this->validate();

        $comment = Comment::findOrFail($this->commentId);

        $newContent = (string)Str::of($this->newContent)->trim();

        $comment->content = $newContent ?? null;
        $comment->save();

        $this->init($comment); // re-initialize the component state with fresh data after saving
    }

    /**
     * Initialize the component state with fresh comment data.
     * 
     * @param Comment $comment
     * @return void
     */
    private function init(Comment $comment)
    {
        $this->origContent = $comment->content;
        $this->newContent = $this->origContent;
    }
    
    /**
     * Render the component view.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.comment-edit');
    }
}
