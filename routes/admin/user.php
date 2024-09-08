<?php

use Illuminate\Support\Facades\Route;

Route::get('/users/new', 'UserController@create')->name('users.create');
Route::post('/users/store', 'UserController@store')->name('users.store');
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user}/edit','UserController@edit')->name('users.edit');
Route::put('/users/{user}/update','UserController@update')->name('users.update');
Route::delete('/users/{user}/delete','UserController@destroy')->name('users.destroy');



