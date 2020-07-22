<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Album;
use App\Song;
use App\Artist;

use App\Http\Resources\Album as AlbumResource;
use App\Http\Resources\Song as SongResource;
use App\Http\Resources\Artist as ArtistResource;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/albums', function () {
    return AlbumResource::collection(Album::paginate(8));
});

Route::get('/albums/year/{year}', function ($year) {
    return AlbumResource::collection(Album::where('year', $year)->paginate(8));
});

Route::get('/albums/name/{name}', function ($name) {
    return AlbumResource::collection(Album::where('name', 'ilike', "%{$name}%")->paginate(8));
});

Route::get('/albums/artist/{name}', function ($name) {
    return AlbumResource::collection(
        Album::whereHas('artists', function($q) use($name) { $q->where('name', 'ilike', "%{$name}%"); })->paginate(8));
});

Route::get('/songs', function () {
    return SongResource::collection(Song::all());
});

Route::get('/artists', function () {
    return ArtistResource::collection(Artist::all());
});

Route::get('/artist/{id}', function ($id) {
    return new ArtistResource(Artist::find($id));
});

Route::get('/song/{id}', function ($id) {
    return new SongResource(Song::find($id));
});

Route::get('/album/{id}', function ($id) {
    return new AlbumResource(Album::find($id));
});


