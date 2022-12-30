<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowHome extends Component
{
    public function goToPost($postId)
    {
        return redirect()->route('post', $postId);
    }

    public function render()
    {
        return view('livewire.show-home');
    }
}
