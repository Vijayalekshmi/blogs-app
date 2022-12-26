<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\PostController;
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
    $posts= Auth::user()->owned_posts;    
    return view('dashboard')->with('posts', $posts);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('posts',[PostController::class, 'index'])->middleware(['auth', 'verified'])->name('posts.index');
Route::get('posts/{post}',[PostController::class, 'show'])->middleware(['auth', 'verified'])->name('posts.show');

require __DIR__.'/auth.php';
