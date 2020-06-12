<?php

use Illuminate\Support\Facades\Route;
use App\Album as Album; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/songs','SongsController@index');

Route::post('/artists/submit', 'ArtistsController@store');
Route::post('/artists/update', 'ArtistsController@update');

Route::get('/albums', 'AlbumsController@index');
Route::get('/artists', 'ArtistsController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
