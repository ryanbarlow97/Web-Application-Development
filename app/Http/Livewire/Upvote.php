<?php

namespace App\Http\Livewire;

use Livewire\Component;

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

        $likeable = $likeableType::find($likeableId);
        $this->upvoted = $likeable->isUpvotedBy(auth()->user());
        $this->likes = $likeable->likes();
    }

    public function upvote()
    {
        $likeable = $this->likeableType::find($this->likeableId);
        $likeable->upvote(auth()->user());
        $this->upvoted = true;
        $this->likes = $likeable->likes();
    }
    
    public function unupvote()
    {
        $likeable = $this->likeableType::find($this->likeableId);
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
