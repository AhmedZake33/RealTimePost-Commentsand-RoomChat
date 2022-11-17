<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('message',[App\Http\Controllers\HomeController::class , 'message']);
Route::get('user/{user}',[App\Http\Controllers\HomeController::class , 'user']);

Route::get('/send/{notification}',[App\Http\Controllers\HomeController::class , 'notification']);

Route::get('/sendMessage/{message}',[App\Http\Controllers\HomeController::class , 'sendMessages']);

Route::get('posts','PostController@indexView');
Route::post('createPost','PostController@create');
Route::post('createComment','CommentController@create');

Route::get('privateMessage/{sender}/{recived}','HomeController@private');
// authEndpoint: '/custom/endpoint/auth'
// Route::get('/custom/endpoint/auth',function(){
//     return Auth::user();
// });


Route::get('notification',function(){
    \App\Events\NotificationEvent::dispatch('data',1);
    return view('notification');
});

Route::get('/token/create','HomeController@token');