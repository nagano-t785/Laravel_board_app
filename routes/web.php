<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// ログイン後のダッシュボード（掲示板へリダイレクト）
Route::middleware(['auth'])->get('/dashboard',function(){
    return redirect()->route('posts.index');
})->name('dashboard');


//ログイン認証後に実行される各機能
Route::middleware('auth')->group(function () {
    // 投稿一覧(topページ)
    Route::get('/', [PostController::class, 'index'])->name('posts.index');

    // 新規更新
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // 編集画面表示
    Route::get('/posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');

    // 投稿内容の更新
    Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update');

    // 投稿内容の削除
    Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

});

//Breezeの認証ルート
require __DIR__.'/auth.php';
