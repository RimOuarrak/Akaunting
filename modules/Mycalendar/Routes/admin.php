<?php

use Illuminate\Support\Facades\Route;

/**
 * 'admin' middleware and 'mycalendar' prefix applied to all routes (including names)
 *
 * @see \App\Providers\Route::register
 */

Route::admin('mycalendar', function () {
    Route::get('/', 'Main@index')->name('index');
});
Route::get('/mycalendar/events', [CalendarController::class, 'events'])->name('calendar.events');

Route::get('mycalendar/index', [CalendarController::class, 'index'])->name('calendar.index');
Route::post('mycalendar', [CalendarController::class, 'store'])->name('calendar.store');

Route::patch('mycalendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
Route::delete('mycalendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');

