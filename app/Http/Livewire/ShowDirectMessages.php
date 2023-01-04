<?php

namespace App\Http\Livewire;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;

class ShowDirectMessages extends Component
{
    public $content;

    public $selectedConversation;

    public function mount()
    {
        if (session()->has('selectedConversation')) {
            return $this->selectedConversation = session('selectedConversation');
        }

        $this->selectedConversation = Conversation::query()
            ->where('sender_id', auth()->id())
            ->orWhere('recipient_id', auth()->id())
            ->first();
    }

    public function sendMessage()
    {
        $conversation = Conversation::find($this->selectedConversation->id);

        Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'user_id' => auth()->id(),
            'content' => $this->content
        ]);

        // Update conversation's updated_at column
        $conversation->touch();

        $this->reset('content');

        $this->viewConversation($this->selectedConversation->id);
    }

    public function viewConversation($conversationId)
    {
        $this->selectedConversation = Conversation::findOrFail($conversationId);

        session(['selectedConversation' => $this->selectedConversation]);

    }

    public function render()
    {
        $conversations = Conversation::query()
            ->where('sender_id', auth()->id())
            ->orWhere('recipient_id', auth()->id())
            ->get();


        return view('livewire.show-direct-messages', [
            'conversations' => $conversations
        ]);
    }
}