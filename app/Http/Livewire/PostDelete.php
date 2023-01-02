<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\DB;


class PostDelete extends Component
{
    public $postId;

    public function mount($postId)
    {
        $this->postId = $postId;

    }

    public function deletePost()
    {
        $post = Post::find($this->postId);
        $post->delete();

        DB::table('notifications')
        ->where('data->type', 'post')
        ->where('data->post_id', $this->postId)
        ->delete();

        DB::table('notifications')
        ->where('data->type', 'comment')
        ->where('data->post_id', $this->postId)
        ->delete();


        //return redirect()->to('/home');

        $this->emit('redirect', '/home');

    }

    public function render()
    {
        return view('livewire.post-delete', [
            'postId' => $this->postId,
        ]);

    }
}