<?php
Route::get('/', function(){ return view('welcome'); });
Route::get('login', function(){ return view('login'); });
Route::get('register', function(){ return view('register'); });

Route::group(['prefix' => 'api'],function(){
    // edit view and Update
    Route::put('{id}/edit', 'UserController@update');
    // profile route
    Route::get('profile/{id}', 'UserController@profile');
    //register route
    Route::post('register','UserController@register');
    //login route
    Route::post('login','UserController@login');
    //delete Route
    Route::delete('{id}/delete','UserController@delete');
    // Logout Route
    Route::get('logout','UserController@logout');
    // Create Role route
    Route::post('/role/create','UserController@role');
});
