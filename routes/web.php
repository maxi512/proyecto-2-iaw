<?php

use Illuminate\Support\Facades\Route;
use App\Album as Album; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::post('submit', 'ArtistsController@store');

Route::get('/albums', 'AlbumsController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
