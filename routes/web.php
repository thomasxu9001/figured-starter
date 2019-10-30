<?php

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
    return redirect()->route('postList');
});

Auth::routes();

Route::view('/posts', 'post/index')->name('postList');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth:web'], function(){
    // Create post
    Route::view('/posts/create', 'post/createPost');
    Route::view('/posts/edit/{id}', 'post/editPost', ['id' => \Request::segment(3)]);
});


// post detail page
Route::view('/posts/{id}', 'post/postDetail', ['id' => \Request::segment(2)]);
