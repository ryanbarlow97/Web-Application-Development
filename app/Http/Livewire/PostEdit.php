<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Str;


class PostEdit extends Component
{
    // properties to hold the comment data
    public $postId;
    public $origContent;
    public $newContent;

    // validation rules
    protected $rules = [
        'newContent' => 'required|string'
    ];

    /**
     * Initialize the component by setting the post data and
     * re-initializing the component state.
     * 
     * @param Post $post
     * @return void
     */
    public function mount(Post $post)
    {
        $this->postId = $post->id;
        $this->origContent = $post->content;

        $this->init($post);
    }

    /**
     * Save the edited comment to the database.
     * 
     * @return void
     */
    public function save()
    {
        // validate form input
        $this->validate();

        $post = Post::findOrFail($this->postId);

        // remove whitespace
        $newContent = (string)Str::of($this->newContent)->trim();

        $post->content = $newContent ?? null;
        $post->save();

        $this->init($post); // re-initialize the component state with fresh data after saving
    }

    /**
     * Initialize the component state with fresh post data.
     * 
     * @param Post $post
     * @return void
     */
    private function init(Post $post)
    {
        $this->origContent = $post->content;
        $this->newContent = $this->origContent;
    }
    
    /**
     * Render the component view.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.comment-edit');
    }
}
