<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;


class PostDelete extends Component
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

        return redirect()->to('/home');
    }

    public function render()
    {
        return view('livewire.post-delete', [
            'postId' => $this->postId,
        ]);

    }
}