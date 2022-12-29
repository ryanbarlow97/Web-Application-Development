<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class HomePostDelete extends Component
{
    public $postId;

    public function mount($postId)
    {
        $this->postId = $postId;

    }

    public function deletePost()
    {
        $post = Post::find($this->postId);
        $post->delete();

        $this->emit('postDeleted', $this->postId);
    }

    public function render()
    {
        return view('livewire.home-post-delete', [
            'postId' => $this->postId,
        ]);    }
}

