<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::redirect('/', 'blogs');

Route::middleware(['auth', 'verified'])
    ->group(function(){
        Route::resource('blogs', BlogController::class)->except(['create', 'edit', 'show']);
        Route::resource('blogs.comments', CommentController::class)->only(['index', 'store', 'destroy']);
    });

require __DIR__.'/auth.php';
