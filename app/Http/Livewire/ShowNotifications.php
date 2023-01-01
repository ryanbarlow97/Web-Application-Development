<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification;

class ShowNotifications extends Component
{
 
    public function goToPost($notificationId)
    {

        // Retrieve the notification from the database
        $notification = auth()->user()->notifications()->find($notificationId);
    
        // Update the read_at field with the current time
        $notification->update(['read_at' => now()]);
    
        // Redirect to the post or comment page
        return redirect(route('post', $notification->data['post_id']));
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
