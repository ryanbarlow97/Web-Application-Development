<?php

namespace App;

use GuzzleHttp\Client;

class Twitch
{
    public $apiKey;
    protected $oauthToken;

    public function __construct($apiKey, $oauthToken)
    {
        $this->apiKey = $apiKey;
        $this->oauthToken = $oauthToken;
    }
    public function getTopStream($position)
    {
        $client = new Client([
            'headers' => [
                'Client-ID' => $this->apiKey,
                'Authorization' => "Bearer {$this->oauthToken}",
            ],
            'query' => [
                'game_id' => '509658',
                'language' => 'en',    
                'sort' => 'trending',    
                'period' => 'day',    
            ],
        ]);      

        $response = $client->get('https://api.twitch.tv/helix/videos?first=1');

        $clips = json_decode($response->getBody());
        return $clips->data[$position];
    }
}