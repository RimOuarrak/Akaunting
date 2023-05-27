<?php

use Illuminate\Support\Facades\Route;

/**
 * 'admin' middleware and 'modulescon' prefix applied to all routes (including names)
 *
 * @see \App\Providers\Route::register
 */


Route::admin('modulescon', function () {
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get('/', 'Settings@index')->name('index');
        Route::get('/', 'Settings@edit')->name('edit');
        Route::post('/', 'Settings@update')->name('update');
        Route::post('get', 'Settings@get')->name('get');
        Route::delete('delete', 'Settings@destroy')->name('delete');
    });
});



//  Route::admin('modulescon', function () {
//     Route::get('/', 'Main@index')->name('index');