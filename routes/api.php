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
Broadcast::routes(['middleware' => ['auth:sanctum']]);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'],function(){


    Route::get('message',[App\Http\Controllers\HomeController::class , 'getMessages']);

    Route::post('/sendMessage',[App\Http\Controllers\HomeController::class , 'sendMessage']);

// Route::middleware('auth:api')->group(function(){
// });

    Route::post('/posts',[App\Http\Controllers\PostController::class,'index']);
    Route::post('/post/create',[App\Http\Controllers\PostController::class,'create']);

// comments
    Route::post('comment/create','CommentController@create');


// private message 
    Route::post('send/private/message','MessageController@sendPrivate');

    Route::post('messages/index','MessageController@index');
});