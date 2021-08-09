<?php

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

Route::name('register')->post('register',[App\Http\Controllers\UserController::class,'createUser']);
Route::name('login')->post('login',[App\Http\Controllers\UserController::class,'login']);
Route::name('getallposts')->get('getallposts',[App\Http\Controllers\PostController::class,'getAllPosts']);
Route::name('searchposts')->get('searchposts',[App\Http\Controllers\PostController::class,'searchPosts']);

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::name('logout')->post('logout',[App\Http\Controllers\UserController::class,'logout']);
    Route::name('createpost')->post('createpost',[App\Http\Controllers\PostController::class,'createNewPost']);
    Route::name('updatepost')->put('updatepost',[App\Http\Controllers\PostController::class,'updatePost']);
    Route::name('deletepost')->delete('deletepost',[App\Http\Controllers\PostController::class,'deletePost']);
});

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
