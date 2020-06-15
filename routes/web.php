<?php

use Illuminate\Support\Facades\Route;
use App\Album as Album; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});
Auth::routes();

Route::get('/albums', 'AlbumsController@index');
Route::get('/songs','SongsController@index');

Route::get('/artists', 'ArtistsController@index');
Route::post('/artists/submit', 'ArtistsController@store');
Route::post('/artists/update', 'ArtistsController@update');
Route::post('/artists/delete/{id}', 'ArtistsController@destroy')->name('artist.delete');

Route::get('/home', 'HomeController@index')->name('home');
