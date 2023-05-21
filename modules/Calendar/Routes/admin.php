<?php

use Illuminate\Support\Facades\Route;

/**
 * 'admin' middleware and 'calendar' prefix applied to all routes (including names)
 *
 * @see \App\Providers\Route::register
 */

Route::admin('calendar', function () {
    Route::get('/', 'Main@index')->name('index');
});
