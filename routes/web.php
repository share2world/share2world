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


Route::get('/', function () {
    $name = "Mrzrb";
    $content = "Think about It, You can do it";
    return view('welcome',compact('name','content'));
});

Route::get('contact','ContactController@index');

