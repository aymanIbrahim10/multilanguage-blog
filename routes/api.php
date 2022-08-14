<?php

use App\Http\Controllers\Api\CategoryAdminController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
route::get('/', function(){
    return 12;
});
Route::get('/settings', [SettingController::class, 'index'])->middleware('auth:sanctum');
Route::get('/category-navbar', [CategoryController::class, 'navbarCategory']);
Route::get('/category-posts', [CategoryController::class, 'indexpagecategorywithpost']);
//category with posts and paginate
Route::get('/categories', [CategoryController::class, 'index']);
//category with his number
Route::get('/categories/{id}', [CategoryController::class, 'show']);

//all posts
route::apiResource('posts',PostController::class)->except(['create','store','update','destroy']);
// auth user
route::post('/login',[LoginController::class, 'login']);
//logout
route::post('/logout',[LoginController::class, 'logout']);
//more about sanctum
route::apiResource('categoryadmin',CategoryAdminController::class)->middleware('auth:sanctum');
