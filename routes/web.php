<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('klijent', 'KlijentController');

    Route::patch('dijagnoza/{id}/edit', "DijagnozaController@edit" );
    Route::resource('dijagnoza', 'DijagnozaController');
    Route::resource('medicinski-karton', 'MedicinskiKartonController');
    Route::get('medicinski-karton/create/{id}', 'MedicinskiKartonController@create');

    Route::resource('pregled', 'PregledController');
    Route::get('pregled/create/{id}', 'PregledController@create');

    Route::get('racun', "RacunController@showRacun");

    Route::get('racun-detaljno/{id}', "RacunController@showRacunDetaljno");

    Route::get('recept', function () {
        return view('recept');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
