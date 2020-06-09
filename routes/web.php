<?php

use Illuminate\Support\Facades\Route;
use App\Album as Album; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/albums', function () {
    $artists = DB::table('artists')->get();
    $albums = Album::with('artists')->get();
    $countries = Countries::getList();
    return view('albums', compact('albums','artists','countries'));
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
