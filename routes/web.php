<?php

use Illuminate\Support\Facades\Route;
use  App\Models\Post;
use  App\Models\User;
use Illuminate\Support\Facades\Auth; 
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

Route::get('/dashboard', function () {
    $userId = Auth::id();
    $posts=Post::with('user')->where('user_id', $userId)
    ->get();
    return view('dashboard',["posts"=>$posts]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
