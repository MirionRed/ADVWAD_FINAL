<?php
Route::get('/customer/{customer}', 'CustomerController@apiShow')
  ->name('customer.api-show');
Route::get('/customer', 'CustomerController@apiIndex')
  ->name('customer.api-index');
