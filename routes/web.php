<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
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

// Route::get('/', function () {
//     return view('welcome');
// });



    Route::get('/', [PageController::class, 'index'])->name('pages.index');
    Route::get('/about', [PageController::class, 'about'])->name('pages.about');
    Route::get('/services', [PageController::class, 'services'])->name('pages.services');

    Route::group(['prefix' => 'posts'], function(){
        Route::get('', [PostController::class, 'index'])->name('post.index');
        Route::get('create', [PostController::class, 'create'])->name('post.create');
        Route::post('store', [PostController::class, 'store'])->name('post.store');
        Route::get('edit/{post}', [PostController::class, 'edit'])->name('post.edit');
        Route::post('update/{post}', [PostController::class, 'update'])->name('post.update');
        Route::post('delete/{post}', [PostController::class, 'destroy'])->name('post.destroy');
        Route::get('show/{post}', [PostController::class, 'show'])->name('post.show');
     });
     