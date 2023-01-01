<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

// Class for generating notifications when a user comments on a post
class CommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    // Variables to store the post, the user who commented, and the comment itself
    private $post;
    private $user;
    private $comment;

    // Constructor to initialize the variables
    public function __construct($post, $user, $comment)
    {
        $this->post = $post;
        $this->user = $user;
        $this->comment = $comment;
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
        // Determine the name of the user who commented
        $userName = $this->user->first_name;

        // Return the data to be stored in the database
        return [
            'type' => "post",
            'post_id' => $this->post->id,
            'comment_id' => $this->comment->id,
            'message' => "Your post was commented on by " . $userName . "!",
        ];
    }
}
