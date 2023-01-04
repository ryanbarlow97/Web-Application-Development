<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;


class ShowProfile extends Component
{
    public $user;
    public $section = 'posts';

    public function mount($user_name)
    {
        $this->user = User::where('user_name', $user_name)->first();
    }

    public function createConversation()
    {
        $sender = Auth::user();
        $recipient = $this->user;
    
        $existingConversation = Conversation::where(function ($query) use ($sender, $recipient) {
            $query->where('sender_id', $sender->id)->where('recipient_id', $recipient->id);
        })->orWhere(function ($query) use ($sender, $recipient) {
            $query->where('sender_id', $recipient->id)->where('recipient_id', $sender->id);
        })->first();
    
        if ($existingConversation) {
            session(['selectedConversation' => $existingConversation]);

            // Conversation already exists, redirect to existing conversation
            return redirect()->route('messages');
        } else {
            // Create new conversation
            $conversation = Conversation::create([
                'sender_id' => $sender->id,
                'recipient_id' => $recipient->id,
            ]);

            session(['selectedConversation' => $conversation]);

            return redirect()->route('messages');
        }
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
