<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/users/{id}', [UserController::class, 'show'])
    ->name('users.show');



require __DIR__.'/auth.php';
