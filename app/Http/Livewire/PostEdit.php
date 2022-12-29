<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostEdit extends Component
{
    public $postId;
    public $editMode = 'savePost';


    public function mount($postId)
    {
        $this->postId = $postId;
        $post = Post::find($postId);
        $this->content = $post->content;
    }

    public function setMode($editMode)
    {
        $this->editMode = $editMode;
    }

    public function editPost()
    {
        $this->validate([
            'content' => 'required'
            
        ]);

        $post = Post::find($this->postId);
        $post->content = $this->content;
        $post->save();

        $this->emit('postEdited', $this->postId);


    }
    
    public function render()
    {
        return view('livewire.post-edit');
    }
}
