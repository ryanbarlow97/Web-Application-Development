<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class ShowHome extends Component
{
    use WithPagination;

    public $listeners = ['newPost' => 'render'];

    public function goToPost($postId)
    {
        return redirect()->route('post', $postId);
    }

    public function render()
    {
        return view('livewire.show-home', [
            'posts' => Post::latest()->paginate(20),
        ]);
    }
}
