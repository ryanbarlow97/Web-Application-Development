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

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');


Route::get('/notifications', function () {
    return view('notifications');
})->middleware(['auth', 'verified'])->name('notifications');

//View Profile ID
Route::get('/profile/{id}', App\Http\Livewire\ShowProfile::class)
    ->middleware(['auth', 'verified'])->name('profile');

//View Post ID
Route::get('/comments/{id}', App\Http\Livewire\ShowPost::class)
    ->middleware(['auth', 'verified'])->name('post');


require __DIR__.'/auth.php';