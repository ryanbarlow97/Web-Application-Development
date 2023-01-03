<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ProfilePictureEdit extends Component
{
    
    use WithFileUploads;

    public $photo;
    public $path;


    public function store()
    {
        $validatedData = $this->validate([
            'photo' => ['required', 'image'],  // 12MB Max
        ]);

        if ($this->photo)
        {
            $path = $this->photo->store('public/profile-picture');
            $path = substr($path, 7);


            $user = auth()->user();
            $user->profile_picture = $path;
            $user->save();
            
        }   

        $this->reset(['photo']);
    }
}
