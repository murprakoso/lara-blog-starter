<?php

use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', function () {
    return redirect('/');
});
Route::get('/blog', [BlogController::class, 'index']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::redirect('', 'admin/dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Route::get('/posts', [PostController::class, 'index'])->name('posts');

    Route::resource('/posts', 'App\Http\Controllers\Admin\PostController');

    Route::resource('/categories', 'App\Http\Controllers\Admin\CategoryController');

    Route::resource('/tags', 'App\Http\Controllers\Admin\TagController');
});


// Route::any('{all}', function () {
//     return view('errors.404');
// })->where('all', '.*');
