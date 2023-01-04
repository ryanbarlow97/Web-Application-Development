<?php

use Illuminate\Support\Facades\Route;
use App\Twitch;
use App\Http\Controllers\TwitchController;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

app()->singleton('App\Twitch', function($app){
    // Obtain the authorization code from the request
    $code = $app['request']->input('code');
    // Exchange the authorization code for an OAuth token
    $client = new Client();
    $response = $client->post('https://id.twitch.tv/oauth2/token', [
        'form_params' => [
            'client_id' => 'j5va83irjijhg8eude3u2ywwahefk4',
            'client_secret' => 'p9resxc1jl1ziw5rctukbj9ucbchgy',
            'code' => $code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => 'http://localhost/twitch',
        ],
    ]);
    
    $responseBody = json_decode($response->getBody());

    $accessToken = $responseBody->access_token;

    // Create a new Twitch API client instance with the OAuth token
    return new Twitch('j5va83irjijhg8eude3u2ywwahefk4', $accessToken);
});

Route::get('/authorise', function () {
    $clientId = 'j5va83irjijhg8eude3u2ywwahefk4';
    $redirectUri = 'http://localhost/twitch';

    $url = "https://id.twitch.tv/oauth2/authorize?client_id={$clientId}&redirect_uri={$redirectUri}&response_type=code";
    return redirect($url);
})->name('authorise');


Route::get('/twitch', [TwitchController::class, 'create']);



Route::get('/', function () {
    return view('welcome');
});

//View the Home Page
Route::get('/home', App\Http\Livewire\ShowHome::class)
    ->middleware(['auth', 'verified'])->name('home'); 

//View Notifications
Route::get('/notifications', App\Http\Livewire\ShowNotifications::class)
    ->middleware(['auth', 'verified'])->name('notifications');

//View Profile ID
Route::get('/profile/@{user_name}', App\Http\Livewire\ShowProfile::class)
    ->middleware(['auth', 'verified'])->name('profile');

//View Profile ID
Route::get('/profile/@{user_name}', App\Http\Livewire\ShowProfile::class)
    ->middleware(['auth', 'verified'])->name('profile');

//View Post and Comments
Route::get('/comments/{id}', App\Http\Livewire\ShowPost::class)
->middleware(['auth', 'verified'])->name('post');

//View User Settings
Route::get('/settings', App\Http\Livewire\ShowProfileEdit::class)
    ->middleware(['auth', 'verified'])->name('settings');

//View Direct Messages
Route::get('/messages', App\Http\Livewire\ShowDirectMessages::class)
->middleware(['auth', 'verified'])->name('messages');

require __DIR__.'/auth.php';