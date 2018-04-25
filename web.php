<?php

Route::get('/customer/create', 'CustomerController@create')
  ->name('customer.create');
Route::post('/customer/store', 'CustomerController@store')
  ->name('customer.store');
Route::get('/customer', 'CustomerController@index')
  ->name('customer.index');
Route::get('/customer/show/{id}', 'CustomerController@show')
  ->name('customer.show');
Route::get('/customer/edit/{id}', 'CustomerController@edit')
  ->name('customer.edit');
Route::post('/customer/update/{id}', 'CustomerController@update')
  ->name('customer.update');
Route::get('/customer/{customer}/upload', 'CustomerController@upload')
  ->name('customer.upload');
Route::post('/customer/{customer}/save-upload', 'CustomerController@saveUpload')
  ->name('customer.saveUpload');

Route::resource('/customer', 'CustomerController');
Route::resource('/customer', 'CustomerController', ['except' => [
  'destroy',]]);

Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//PROTECTING routes
Route::get('profile', function(){
  //authenticated users enter
})->middleware('auth');
Route::get('/post/{post}', function(Post $post){
  //authenticated users enter
})->middleware('can:update,post');//HAVE MODEL
Route::get('/post', function(){
  //authenticated users enter
})->middleware('can:update,App\post');//NO MODEL
