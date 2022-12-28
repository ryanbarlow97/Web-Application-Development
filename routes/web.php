<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UpvoteController;
use App\Http\Controllers\CommentController;

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

//Profile Posts
Route::get('/users/{id}/posts', [UserController::class, 'posts'])
    ->name('users.posts');
//Profile Comments
Route::get('/users/{id}/comments', [UserController::class, 'comments'])
    ->name('users.comments');
//Profile Liked Posts
Route::get('/users/{id}/liked_posts', [UserController::class, 'likedPosts'])
    ->name('users.liked_posts');
//Profile Liked Comments
Route::get('/users/{id}/liked_comments', [UserController::class, 'likedComments'])
    ->name('users.liked_comments');

//View User ID
Route::get('/users/{id}', [UserController::class, 'show'])
->name('users.show');


//View Post ID
Route::get('/posts/{id}', App\Http\Livewire\ShowPost::class);

//Create Post

//Create Comment
Route::get('/upvote', App\Http\Livewire\Upvote::class);


require __DIR__.'/auth.php';