<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Models\Post; 

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\SpellCheck;

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
app()->singleton(SpellCheck::class, function ($app) {
    return new SpellCheck(env('SPELL_API_KEY'));
},true);



Route::get('/', function () {   
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {   
    $user = Auth::user();
    $posts = $user->owned_posts()->orderBy('created_at', 'DESC')->paginate(8);  
    return view('dashboard')->with('posts', $posts);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('posts',[PostController::class, 'index'])->middleware(['auth', 'verified'])->name('posts.index');
Route::get('posts/create',[PostController::class, 'create'])->middleware(['auth', 'verified'])->name('posts.create');
Route::get('posts/{post}',[PostController::class, 'show'])->middleware(['auth', 'verified'])->name('posts.show');
Route::post('posts',[PostController::class, 'store'])->middleware(['auth', 'verified'])->name('posts.store');
Route::get('posts/{post}/edit',[PostController::class, 'edit'])->middleware(['auth', 'verified'])->name('posts.edit');
Route::patch('posts/{post}/edit',[PostController::class, 'update'])->middleware(['auth', 'verified'])->name('posts.update');
Route::post('/posts/{post}/like', [PostController::class, 'like'])->middleware(['auth', 'verified'])->name('posts.like');
Route::post('/posts/check-spell/{word}', [PostController::class, 'checkSpell'])->middleware(['auth', 'verified'])->name('posts.checkSpell');

Route::get('users/{user}',[UserController::class, 'show'])->middleware(['auth', 'verified'])->name('users.show');
Route::post('comments',[CommentController::class, 'store'])->middleware(['auth', 'verified'])->name('comments.store');
Route::post('/comments/{postComment}/edit',[CommentController::class, 'update'])->middleware(['auth', 'verified'])->name('comments.update');



require __DIR__.'/auth.php';
