<?php

use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';