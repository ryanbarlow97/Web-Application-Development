<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;


class ShowProfile extends Component
{
    public $user;
    public $section = 'posts';

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }

    public function setSection($section)
    {
        $this->section = $section;
    }

    public function render()
    {
        return view('livewire.show-profile', [
            'users' => $this->user
        ]);
    }

}
