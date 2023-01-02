<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostEdit extends Component
{
    public $postId;
    public $editMode = 'savePost';
    public $content;
    public $listeners = ['editPost'];

    public function mount($postId)
    {
 
        $this->postId = $postId;
        $post = Post::find($postId);
        $this->content = $post->content;
    }

    public function setEdit()
    {
        $this->editMode = 'editPost';
        $this->emit('editing', $this->postId);
    }

    public function setSave()
    {
        $this->editMode = 'savePost';
        $this->emit('saved', $this->postId);
    }

    public function editPost($content)
    {
        $this->content = $content['content'];

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
