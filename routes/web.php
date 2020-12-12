<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;

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
    return view('pages.welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\PagesController::class, 'home']);
Route::get('/about', [App\Http\Controllers\PagesController::class, 'about']);

// Route::resource('/admin/users', 'App\Http\Controllers\Admin\UsersController');
/* Here is an Advanced Routing for /admin/users */
Route::prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', UsersController::class);  
});

Route::resource('posts', App\Http\Controllers\PostsController::class);

//route for ckeditor image uploading
Route::post('ckeditor/image_upload', 'PostsController@upload') ->name ('upload');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);// ->name('dashboard');
