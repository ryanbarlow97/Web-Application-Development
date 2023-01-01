<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Notifications\LikeNotification;

class Upvote extends Component
{
    public $likeableType;
    public $likeableId;
    public $upvoted;
    public $likes;

    public function mount($likeableType, $likeableId)
    {
        $this->likeableType = $likeableType;
        $this->likeableId = $likeableId;

        if (!$this->likeableType || !$this->likeableId) {
            return;
        }

        $likeable = $likeableType::find($likeableId);

        if (!$likeable) {
            return;
        }

        $this->upvoted = $likeable->isUpvotedBy(auth()->user());
        $this->likes = $likeable->likes();
    }

    public function upvote()
    {
        $this->validate([
            'likeableId' => ['required', 'numeric'],
            'likeableType' => ['required', 'string'],
        ]);

        if (!$this->likeableType || !$this->likeableId) {
            return;
        }

        $likeable = $this->likeableType::find($this->likeableId);

        if (!$likeable) {
            return;
        }

        $likeable->upvote(auth()->user());
        $this->upvoted = true;
        $this->likes = $likeable->likes();
        if ($likeable->user_id != auth()->user()->id) {
            $likeable->user->notify(new LikeNotification($likeable, auth()->user()));
        }
    }

    public function unupvote()
    {
        $this->validate([
            'likeableId' => ['required', 'numeric'],
            'likeableType' => ['required', 'string'],
        ]);

        if (!$this->likeableType || !$this->likeableId) {
            return;
        }

        $likeable = $this->likeableType::find($this->likeableId);

        if (!$likeable) {
            return;
        }

        $likeable->unupvote(auth()->user());
        $this->upvoted = false;
        $this->likes = $likeable->likes();
    }

    public function render()
    {
        return view('livewire.upvote', [
            'likes' => $this->likes,
        ]);
    } 
}
