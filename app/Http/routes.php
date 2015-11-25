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
Route::get('/', function() {
    return view('pages.home');
});

Route::get('reservation/entries', ['uses' => '\App\Http\Controllers\ReservationController@entries', 'as' => 'reservation.entries']);
Route::get('reservation/remove-csv', ['uses' => '\App\Http\Controllers\ReservationController@removeCsv', 'as' => 'reservation.remove_csv']);
Route::get('reservation/download-csv', ['uses' => '\App\Http\Controllers\ReservationController@downloadCsv', 'as' => 'reservation.download_csv']);

Route::resource('reservation', '\App\Http\Controllers\ReservationController', [
    'names' => [
        'index' => 'reservation.index',
        'create' => 'reservation.create',
        'store' => 'reservation.store'
    ]
]);
