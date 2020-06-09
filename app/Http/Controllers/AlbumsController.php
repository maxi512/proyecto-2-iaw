<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Album;
use Countries;


class AlbumsController extends Controller
{
    public function index(){
        $artists = DB::table('artists')->get();
        $albums = Album::with('artists')->get();
        $countries = Countries::getList();
        return view('albums', compact('albums','artists','countries'));
    }
}
