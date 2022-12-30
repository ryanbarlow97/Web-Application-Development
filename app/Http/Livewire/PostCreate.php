<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostCreate extends Component
{
    public $content;

    public function store()
    {
        $validatedData = $this->validate([
            'content' => 'required',
        ]);

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'content' => $this->content,
            'flair'   => "demo",
        ]);

        $this->reset(['content']);

        $this->emit('newPost');


    }
    public function render()
    {
        return view('livewire.post-create');
    }    
}