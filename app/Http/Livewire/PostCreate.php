<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Image;
use Livewire\WithFileUploads;


class PostCreate extends Component
{

    use WithFileUploads;

    public $content;
    public $photo;
    public $path;


    public function store()
    {
        $validatedData = $this->validate([
            'content' => 'required',
            'photo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif', 'max:12288'],
        ]);

        if ($this->photo)
        {
            $path = $this->photo->store('public/posts');
            $path = substr($path, 7);
            

            $post = Post::create([
                'user_id' => auth()->user()->id,
                'content' => $this->content,
                'flair'   => "image",
            ]);

            // Save the image path to the database
            $image = new Image;
            $image->path = $path;
            $image->post_id = $post->id;
            $image->save();
        } else {
            $post = Post::create([
                'user_id' => auth()->user()->id,
                'content' => $this->content,
                'flair'   => "text",
            ]);
        }       

        $this->reset(['content', 'photo']);

        $this->emit('newPost');
    }


    public function removeImage()
    {
        $this->reset(['photo']);
        $this->photo = null;
    }

    public function addTopTwitchVideo()
    {
        return redirect()->route('authorise');
    }
}