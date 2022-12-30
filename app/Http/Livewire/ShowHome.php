<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowHome extends Component
{
    public $listeners = ['newPost' => 'refresh'];

    public function goToPost($postId)
    {
        return redirect()->route('post', $postId);
    }

    public function refresh()
    {
        return;
    }

    public function render()
    {
        return view('livewire.show-home');
    }
}
