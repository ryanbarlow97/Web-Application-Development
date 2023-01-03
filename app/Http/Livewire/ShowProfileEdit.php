<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ShowProfileEdit extends Component
{
    use WithFileUploads;

    public $photo;
    public $path;

    
    public function render()
    {
        return view('livewire.show-profile-edit');
    }
}
