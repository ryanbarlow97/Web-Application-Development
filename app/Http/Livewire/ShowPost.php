<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;

class ShowPost extends Component
{
    public $post;

    public function mount($id)
    {
        $this->post = Post::findOrFail($id);
        
        if (! $this->post) {
            // post was not found, redirect the user to the home page
            return $this->redirect('/home');
        }
    }

    public function render()
    {
        return view('livewire.show-post');
    }
}
