<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Album;

class AlbumsController extends Controller
{
    public function index(){
        $artists = DB::table('artists')->get();
        $albums = Album::with('artists')->get();
        return view('albums', compact('albums','artists'));
    }
}
