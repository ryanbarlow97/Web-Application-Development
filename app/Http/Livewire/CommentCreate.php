<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class CommentCreate extends Component
{
    public $content;
    public $post_id;
    public $user_id;

    public function mount($post_id)
    {
        $this->post_id = $post_id;
        $this->user_id = auth()->user()->id;
        $this->comments = Comment::where('post_id', $post_id)->get();

    }

    public function store()
    {
        $validatedData = $this->validate([
            'content' => 'required',
        ]);

        $comment = Comment::create([
            'content' => $this->content,
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
        ]);

        $this->reset(['content']);

        $this->emit('newComment');


    }
    public function render()
    {
        return view('livewire.comment-create');
    }    
}

