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


Route::get('/', 'HomeController@index');

Route::get('contact','ContactController@index');


Route::get('test',function () {
    return view('admin/test');
});

Route::get('login',function(){
    return view('home.login');
});



Route::group(['namespace' => 'Admin'], function() {
    // if(!Auth::check()){
    //     return redirect('/login');
    // }
    Route::get('tt','AdminController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
