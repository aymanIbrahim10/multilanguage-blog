<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Website\IndexController;
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
,'CheckUser'
*/

Route::get('/', [IndexController::class, 'index'])->name('frontend');
Route::get('/categories/{category}', [\App\Http\Controllers\Website\CategoryController::class, 'show'])->name('category.frontend');
Route::get('/post/{post}', [\App\Http\Controllers\Website\PostController::class, 'show'])->name('post');


Route::group(['prefix' => 'home', 'middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('dashboard.home');
    })->name('dashboard');

    Route::get('/users/all', [UserController::class, 'getUsersDatatable'])->name('users.all');
    Route::post('/users/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/users/privacy', [UserController::class, 'passView'])->name('users.edit.pass');
    Route::post('/users/privacy/update', [UserController::class, 'passwordChange'])->name('users.edit.pass.update');

    Route::get('/categories/all', [CategoryController::class, 'getCategoriesDatatable'])->name('categories.all');
    Route::post('/categories/delete', [CategoryController::class, 'delete'])->name('categories.delete');

    Route::get('/posts/all', [PostController::class, 'getPostsDatatable'])->name('posts.all');
    Route::post('/posts/delete', [PostController::class, 'delete'])->name('posts.delete');


    Route::resources([
        'users' => UserController::class,
        'categories' => CategoryController::class,
        'posts' => PostController::class,
    ]);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
});

require __DIR__ . '/auth.php';
