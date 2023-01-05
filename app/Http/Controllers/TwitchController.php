<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Twitch;

class TwitchController extends Controller
{
    public function create(Post $post, Twitch $twitch)
    {
        $position = rand(0,19);
        $clip = $twitch->getTopStream($position);

        $string = $clip->thumbnail_url;

        if ( $string == 'https://vod-secure.twitch.tv/_404/404_processing_%{width}x%{height}.png') {
            $string = 'https://vod-secure.twitch.tv/_404/404_processing_320x180.png';
        }
        else if (strpos($string, '%{width}x%{height}') !== false) {
            $string = str_replace('%{width}x%{height}', '1920x1080', $string);
        }

        $post->create([
            'user_id' => auth()->user()->id,
            'content' => json_encode([
                "username" => $clip->user_name,
                "title" => $clip->title,
                "url" => $clip->url,
                "thumbnail_url" => $string,
                "position" => $position+1
            ]),
            'flair' => 'twitch',
        ]);        

        return redirect('/home');
    }
}