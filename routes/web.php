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
    Route::get('/albums/show/{id}', 'AlbumsController@show');
    Route::get('/albums/{id}/cover', 'AlbumsController@getCover');

    Route::get('/faqs', function () {
        return view('faqs');
    });

    //utilities
    Route::get('/artists/{id}/albums', 'ArtistsController@getAlbums');
    Route::get('/albums/{id}/artists', 'AlbumsController@getArtists');
    Route::get('/songs/{id}/artists', 'SongsController@getArtists');

    Route::group(['middleware' => ['can:update albums']], function () {
        Route::get('/artists/all', 'ArtistsController@getArtists');
        Route::post('/albums/submit','AlbumsController@store');
        Route::post('/albums/update', 'AlbumsController@update');
    });

    Route::group(['middleware' => ['can:delete albums']], function () {
        Route::post('/albums/delete/{id}', 'AlbumsController@destroy');
    });

    Route::group(['middleware' => ['can:delete songs']], function () {
        Route::post('/songs/delete/{id}','SongsController@destroy');
    });

    Route::group(['middleware' => ['can:update songs']], function () {
        Route::post('/songs/submit','SongsController@store');
        Route::post('/songs/update','SongsController@update');
        Route::get('/artists/all', 'ArtistsController@getArtists');
        Route::get('/songs/{id}/artists', 'SongsController@getArtists');
        Route::get('/albums/albumsfromlist', 'AlbumsController@albumsFromList');
    });   

    Route::group(['middleware' => ['can:update artists']], function () {
        Route::post('/artists/submit', 'ArtistsController@store');
        Route::post('/artists/update', 'ArtistsController@update');
    });

    Route::group(['middleware' => ['can:delete artists']], function () {
        Route::post('/artists/delete/{id}', 'ArtistsController@destroy');
    });

    Route::group(['middleware' => ['can:update users']], function () {
        Route::get('/users', 'UsersController@index');
        Route::post('/users/update', 'UsersController@update');
    });
  
});




