<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('reservation/entries', ['uses' => '\App\Http\Controllers\ReservationController@entries', 'as' => 'reservation.entries']);

Route::resource('reservation', '\App\Http\Controllers\ReservationController', [
    'names' => [
        'index' => 'reservation.index',
        'create' => 'reservation.create',
        'store' => 'reservation.store'
    ]
]);
