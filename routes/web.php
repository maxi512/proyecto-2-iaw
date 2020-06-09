<?php

use Illuminate\Support\Facades\Route;
use App\Song as Song; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/albums', function () {
   $song = Song::find(1);
   return view('albums', compact('song'));
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
