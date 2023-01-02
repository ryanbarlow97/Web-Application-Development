<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Notifications\LikeNotification;
use Illuminate\Support\Facades\DB;

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

        if($this->likeableType == "App\Models\Post")
        {
            DB::table('notifications')
                ->where('data->type', 'likepost')
                ->where('data->post_id', $likeable->id)
                ->delete();
        } else {
            DB::table('notifications')
                ->where('data->type', 'likecomment')
                ->where('data->comment_id', $likeable->id)
                ->delete();
        }
    }

    public function render()
    {
        return view('livewire.upvote', [
            'likes' => $this->likes,
        ]);
    } 
}
