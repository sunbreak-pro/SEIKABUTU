<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;



Route::get('/', function () {
    return view('welcome');
});


Route::controller(TodoListController::class)->middleware(['auth'])->group(function () {

    Route::get('/lists/create', 'create')->name('create');
    Route::get('/lists/show', 'show')->name('show');
    Route::get('/lists/archievement', 'archievement_list')->name('archievement_list');
    Route::put('/lists/{list}/update', 'update')->name('update');
    Route::put('/lists/{list}/archievement', 'archievement')->name('archievement');
    Route::put('/lists/{list}/back', 'back')->name('back');
    Route::post('/lists/store', 'store')->name('store');
    Route::get('/lists/{list}/edit', 'edit')->name('edit');
    Route::delete('/lists/{list}/delete', 'delete')->name('delete');
});

Route::controller(PostController::class)->middleware(['auth'])->group(function () {
    Route::get('/', 'index')->name('index');
    Route::put('/lists/lists/{list}/post', 'post')->name('post');
});

Route::post('/lists/like', [LikeController::class, 'likeList']);

Route::post('/lists/{list}/comments', [CommentController::class, 'store'])->name('comments.store');


Route::get('/profile/{id}', [ProfileController::class, 'get_user']);

//フォロー状態の確認
Route::get('/follow/status/{id}', [FollowController::class, 'check_following']);

//フォロー付与
Route::post('/follow/add', [FollowController::class, 'following']);

//フォロー解除
Route::post('/follow/remove', [FollowController::class, 'unfollowing']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
