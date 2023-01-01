<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

// Class for generating notifications when a user likes an interactable item (such as a post or comment)
class LikeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    // Variables to store the interactable item and the user who liked it
    private $interactable;
    private $user;

    // Constructor to initialize the variables
    public function __construct($interactable, $user)
    {
        $this->interactable = $interactable;
        $this->user = $user;
    }

    // Specify the channels through which the notification should be sent
    public function via($notifiable)
    {
        // In this case, the notification will be stored in the database
        return ['database'];
    }

    // Return an array of data to be stored in the database
    public function toArray($notifiable)
    {
        // Determine the name of the user who liked the item
        $userName = (Auth::user()->id == $this->interactable->user->id) ? "you" : $this->user->first_name;

        // Initialize variables
        $contentId = null;
        $action = null;

        // Determine the type of the interactable item (post or comment) and the appropriate action string
        switch (get_class($this->interactable)) {
            case 'App\Models\Post':
                $type = "post";
                $postId = $this->interactable->id;
                $action = "Your post was liked by ";
                break;
            case 'App\Models\Comment':
                $type = "comment";
                $postId =  $this->interactable->post->id;
                $contentId = $this->interactable->id;
                $action = "Your comment was liked by ";
                break;
        }

        // Return the data to be stored in the database if the action string is not null
        if ($action != null) {
            return [
                'type' => $type,
                'post_id' => $postId,
                'content_id' => $contentId,
                'message' => $action . $userName . "!",
            ];
        }
    }
}
