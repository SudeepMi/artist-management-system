<?php

use Illuminate\Support\Facades\Route;

Route::get('/artists/new', 'ArtistController@create')->name('artists.create');
Route::post('/artists/store', 'ArtistController@store')->name('artists.store');
Route::get('/artists', 'ArtistController@index')->name('artists.index');
Route::get('/artists/{artist}/edit', 'ArtistController@edit')->name('artists.edit');
Route::put('/artists/{artist}/update', 'ArtistController@update')->name('artists.update');
Route::delete('/artists/{artist}/delete', 'ArtistController@destroy')->name('artists.destroy');
Route::get('/artists/{artist}/songs', 'ArtistController@artistSong')->name('artists.songs');
Route::get('/artists/import', 'ArtistController@import')->name('artists.import');
Route::post('/artists/import', 'ArtistController@importPost')->name('artists.import.save');
Route::get('/artists/export', 'ArtistController@export')->name('artists.export');
Route::post('/artists/export', 'ArtistController@exportPost')->name('artists.export.save');
