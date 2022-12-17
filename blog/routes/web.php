<?php

use App\Http\Controllers\cms\PostController;
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
    return view('cms.master');
});


Route::prefix('admin')->name('admin.')->middleware('auth','admin')->group(function() {
      // /posts/{post}
      Route::get('posts/trash', [PostController::class, 'trash'])->name('posts.trash');
      Route::get('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore')->withTrashed();
      Route::get('posts/{post}/forcedelete', [PostController::class, 'forcedelete'])->name('posts.forcedelete')->withTrashed();
    Route::resource('posts', PostController::class);

});

Route::fallback(function() {
    return view('errors.404');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
