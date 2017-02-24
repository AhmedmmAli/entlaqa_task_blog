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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index');
/*
Route::get('/', function(){
     return view('home/index');
});
*/
Route::resource('/Posts','PostsController');
Route::get('/','PostsController@index');
Route::resource('/Comments','CommentsController');
Route::get('/add/{postid}/{com_body}','CommentsController@store');