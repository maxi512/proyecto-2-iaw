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

Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/songs','SongsController@index');
    Route::get('/albums', 'AlbumsController@index');
    Route::get('/artists', 'ArtistsController@index');

    Route::get('/songs/{id}/artists', 'SongsController@getArtists');
    Route::get('/albums/albumsfromlist', 'AlbumsController@albumsFromList');
    Route::get('/artists/{id}/albums', 'ArtistsController@getAlbums');
    Route::get('/artists/all', 'ArtistsController@getArtists');

    Route::get('/albums/{id}/cover', 'AlbumsController@getCover');


    Route::post('/albums/submit','AlbumsController@store');

    Route::group(['middleware' => ['can:delete albums']], function () {
         
    });

    Route::group(['middleware' => ['can:delete songs']], function () {
         Route::post('/songs/delete/{id}','SongsController@destroy');
    });

    Route::group(['middleware' => ['can:update songs']], function () {
        Route::post('/songs/submit','SongsController@store');
        Route::post('/songs/update','SongsController@update');
    });
    

    Route::group(['middleware' => ['can:update artists']], function () {
        Route::post('/artists/submit', 'ArtistsController@store');
        Route::post('/artists/update', 'ArtistsController@update');
    });

    Route::group(['middleware' => ['can:delete artists']], function () {
        Route::post('/artists/delete/{id}', 'ArtistsController@destroy')->name('artist.delete');
    });

    Route::group(['middleware' => ['can:edit users']], function () {
        Route::get('/users', 'UsersController@index');
        Route::post('/users/update', 'UsersController@update');
    });
  
});




