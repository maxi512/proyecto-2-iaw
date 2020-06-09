<?php

use Illuminate\Support\Facades\Route;
use App\Song as Song; 

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
