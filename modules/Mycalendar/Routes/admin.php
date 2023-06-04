<?php

use Illuminate\Support\Facades\Route;
use Modules\Mycalendar\Http\Controllers\Main;

Route::admin('mycalendar', function () {
    Route::get('/', [Main::class, 'index'])->name('index');
    Route::post('events', [Main::class, 'store'])->name('events.store');
    Route::post('store', [Main::class, 'store'])->name('store');
    Route::patch('update/{id}', [Main::class, 'update'])->name('update');
    Route::patch('events/{id}', [Main::class, 'update'])->name('events.update');
    Route::delete('destroy/{id}', [Main::class, 'destroy'])->name('destroy');
});

Route::api('mycalendar', function () {
    Route::get('posts/{post}/enable', 'Posts@enable')->name('mycalendar.posts.enable');
    Route::get('posts/{post}/disable', 'Posts@disable')->name('mycalendar.posts.disable');
    Route::resource('posts', 'Posts');
    Route::resource('comments', 'Comments');
});

Route::get('mycalendar/events', [Main::class, 'events'])->name('mycalendar.events');
Route::delete('mycalendar/events/{id}', [Main::class, 'destroy'])->name('mycalendar.events.destroy');
Route::patch('mycalendar/events/{id}', [Main::class, 'update'])->name('mycalendar.events.update');

