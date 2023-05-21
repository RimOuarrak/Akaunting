<?php

use Illuminate\Support\Facades\Route;

/**
 * 'portal' middleware and 'portal/calendar' prefix applied to all routes (including names)
 *
 * @see \App\Providers\Route::register
 */

Route::portal('calendar', function () {
    Route::get('calendar', 'Main@index')->name('calendar.index');
    // Route::get('invoices/{invoice}', 'Main@show')->name('invoices.show');
    // Route::post('invoices/{invoice}/confirm', 'Main@confirm')->name('invoices.confirm');
});
