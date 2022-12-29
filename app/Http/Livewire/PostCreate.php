<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class PostCreate extends Component
{
    use WithFileUploads;

    public $content;
    public $photoUrl;
    public $photo;


    public function fileChanged()
    {
        $filename = Uuid::uuid4()->toString();
        $filename = $filename . '.jpg';

        $this->photoUrl = Storage::disk('public/posts')->url($filename);
    }
    
    public function store()
    {
        $validatedData = $this->validate([
            'content' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'photoUrl' => 'string|max:1024',
        ]);

        $post = Post::create([
            'content' => $this->content,
            ''

        ]);

        $this->reset(['content']);
    }

    public function render()
    {
        return view('livewire.post-create');
    }
}
