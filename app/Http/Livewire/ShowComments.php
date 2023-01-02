<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;

class ShowComments extends Component
{

    public $post;
    public $comments = [];
    public $comment;
    public $listeners = ['newComment' => 'refresh'];

    public function mount($post)
    {
        $this->post = Post::findOrFail($post->id);
        $this->comments = $this->post->comments;

    }

    public function refresh()
    {
        return;
    }

    public function render()
    {
        return view('livewire.show-comments');
    }
}
