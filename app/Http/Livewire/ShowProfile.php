<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;


class ShowProfile extends Component
{
    public $user;
    public $section = 'posts';

    public function mount($user_name)
    {
        $this->user = User::where('user_name', $user_name)->first();
    }

    public function setSection($section)
    {
        $this->section = $section;
    }

    public function goToPost($postId)
    {
        return redirect()->route('post', $postId);
    }

    public function render()
    {
        return view('livewire.show-profile', [
            'users' => $this->user
        ]);
    }

}
