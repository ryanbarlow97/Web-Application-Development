<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification;

class ShowNotifications extends Component
{
 
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
        // Pass the notifications to the view
        return view('livewire.show-notifications');
    }
}
