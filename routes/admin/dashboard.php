<?php

use Illuminate\Support\Facades\Route;

Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

