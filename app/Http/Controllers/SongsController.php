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

    private function getStoreValidator($request){
        $validator =  Validator::make($request->all(),[
            'name' => 'required',
            'artists' => "required|array|min:1",
            'artists.*'=> "required|distinct",  
            'album' => 'required',
            'youtube_link' => 'required|url',
            'duration' => 'required|numeric'
        ]);
        
        $validator->after(function($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('addError', 'None');
            }
        });

        return $validator;
    }

    private function checkDiffArtist($album, $artistsId){
        $artistsInSong = Artist::findMany($artistsId);
        $diffArtist = FALSE;
        foreach($artistsInSong as $artistInSong){
            if(!($album->artists->contains('id', $artistInSong->id))){
                $diffArtist = TRUE;
            break;
            }
        }
        return $diffArtist;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = $this->getStoreValidator($request);
        $validator->validate();

        $song = new Song;
        $album = Album::find($request->album);

        $song->name = $request->name;
        $song->duration = $request->duration;
        $song->youtube_link = $request->youtube_link;
        
        if($this->checkDiffArtist($album, $request->artists)){
            return Redirect::back()->with('artistsError', 'You have some songs that dont match these artists');
        }
        else{
            $song->album()->associate($album);
            $song->save();
            $song->artists()->attach($request->artists);
            return Redirect::back()->with('success', 'Song added!');
        } 
    }

    private function getUpdateValidator($request){
        $validator =  Validator::make($request->all(),[
            'name' => 'required',
            'artists' => "required|array|min:1",
            'artists.*'=> "required|distinct",
            'album' => 'required',
            'youtube_link' => 'required|url',
            'duration' => 'required|numeric'
        ]);
        
        $validator->after(function($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('updateError', 'None');
            }
        });

        return $validator;
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
        $validator = $this->getUpdateValidator($request);
        $validator->validate();
        
        $song = Song::find($request->id);
        $album = Album::find($request->album);

        $song->name = $request->name;
        
        $song->duration = $request->duration;
        $song->youtube_link = $request->youtube_link;

        if($this->checkDiffArtist($album, $request->artists)){
            return Redirect::back()->with('artistsError', 'You have some songs that dont match these artists');
        }
        else{
            $song->album()->associate($album);
            $song->save();
            $song->artists()->detach();
            $song->artists()->attach($request->artists);
            return Redirect::back()->with('status', 'Song Updated!');
        }   
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
        return Redirect::back()->with('statusDelete', 'Song Deleted!');

    }

    public function getArtists($id){
        $song = Song::find($id);
        return $song->artists;
    }
}
