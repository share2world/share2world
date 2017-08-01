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

// Route::get('/',function(){
//     return debug_backtrace();
// });


Route::get('/', 'TaskController@getTask');


Route::get('login',function(){
    return view('home.login');
});


Route::group(['namespace' => 'Admin'], function() {
    Route::get('tt','AdminController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'task'], function() {
    Route::get('/','TaskController@getTask');
    Route::post('/','TaskController@postTask');
    Route::get('complete/{id}','TaskController@changeStatus');
    Route::get('delete/{id}','TaskController@deleteTask');
});

