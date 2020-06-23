<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Redirect;
use DB;
use App\Song;
use App\Artist;
use App\Album;
use Validator;
class SongsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = Song::with('artists')->get();
        $artists = Artist::all();
        $albums = Album::all();
        return view('songs',compact('songs','artists','albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
       $validator =  Validator::make($request->all(),[
            'name' => 'required',
            'artists' => "required|array|min:1",
            'artists.*'=> "required|distinct",  
            'album' => 'required',
            'youtube_link' => 'required|url',
            'duration' => 'required'
        ]);
        
        $validator->after(function($validator) {
            $validator->errors()->add('addError', 'NO');
        });

        $validator->validate();
    
        $song = new Song;
        $album = Album::find($request->album);

        $song->name = $request->name;
        $song->album()->associate($album);
        $song->duration = $request->duration;
        $song->youtube_link = $request->youtube_link;

        $song->save();
        $song->artists()->attach($request->artists);
        return Redirect::back()->with('success', '!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'name' => 'required',
            'artists' => "required|array|min:1",
            'artists.*'=> "required|distinct",
            'album' => 'required',
            'youtube_link' => 'required|url',
            'duration' => 'required'
        ]);
        
        $validator->after(function($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('updateError', 'None');
            }
        });

        $validator->validate();
        
        $song = Song::find($request->id);
        $album = Album::find($request->album);

        $song->name = $request->name;
        $song->album()->associate($album);
        $song->duration = $request->duration;
        $song->youtube_link = $request->youtube_link;
        
        $song->artists()->detach();
        $song->artists()->attach($request->artists);

        $song->save();
        return Redirect::back()->with('status', 'Song Updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $song = Song::find($id);
        $song->delete();
        return Redirect::back()->with('statusDelete', 'Artist Deleted!');

    }

    public function getArtists($id){
        $song = Song::find($id);
        return $song->artists;
    }
}
