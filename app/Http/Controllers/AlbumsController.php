<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use DB;
use Redirect;
use App\Artist;
use Validator;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $artists = DB::table('artists')->get();
        $albums = Album::with('artists')->get();
        return view('albums', compact('albums','artists'));
    }


    private function fileToBase64($file){
        $content = $file->openFile()->fread($file->getSize());
        return base64_encode($content);
    }

    private function getAddValidator($request){
        $validator =  Validator::make($request->all(),[
            'name' => 'required',
            'artists' => "required|array|min:1",
            'artists.*'=> "required|distinct",
            'cover' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        
        $validator->after(function($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('addError', 'No changes on store.');
            }
        });
        return $validator;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = $this->getAddValidator($request);
        $validator->validate();

        $album = new Album;
        $album->name = $request->name;
        $album->image = $this->fileToBase64($request->file('cover'));

        $artists = $request->artists;
       
        $album->save();
        $album->artists()->attach($artists);
        return Redirect::back()->with('success', 'Album Created!'); 
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::find($id);
        return view('showAlbums', compact('album'));
    }

    private function getUpdateValidator($request){
        $validator =  Validator::make($request->all(),[
            'name' => 'required',
            'artists' => "required|array|min:1",
            'artists.*'=> "required|distinct",
            'cover' => "nullable|mimes:jpeg,jpg,png,gif|max:10000"
        ]);

        $validator->after(function($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('updateAlbumError', 'No changes on update.');
            }
        });

        return $validator;
    }

    private function checkDiffArtist($album, $artistsId){
        $artistsInAlbum = Artist::findMany($artistsId);
        $diffArtist = FALSE;
        foreach ($album->songs as $song){
            foreach($song->artists as $artistInSong){
                if(!($artistsInAlbum->contains('id', $artistInSong->id))){
                    $diffArtist = TRUE;
                }
            }
        }
        return $diffArtist;
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

        $album = Album::find($request->album);
        $album->name = $request->name;

        if($request->has('cover')){
            $album->image = $this->fileToBase64($request->file('cover')); 
        }

        if($this->checkDiffArtist($album, $request->artists)){
            return Redirect::back()->with('artistsError', 'You have some songs that dont match these artists');
        }
        else{
            $album->artists()->detach();
            $album->artists()->attach($request->artists);
            $album->save();
            return Redirect::back()->with('successUpdate', 'Album Updated!');
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
        $album = Album::find($id);
        $album->delete();
        return Redirect::back()->with('statusDeleteAlbum', 'Album Deleted!');
    }

    public function allAlbums(){
        return Album::all();
    }

    public function albumsFromList(Request $request)
    {    
        $collection = collect([]);
        foreach(array_unique($request->artists) as $artist){

            $albums = Artist::find($artist)->albums;

            foreach($albums as $album){
                $condition = TRUE;
                foreach(array_unique($request->artists)  as $artistAux){
                    if(!($album->artists->contains('id', $artistAux))){
                        $condition = false;    
                    }
                }
                if($condition){
                    $collection->push($album);
                }
            }
        }
        return $collection->unique('id');
    }

    public function getCover($id){
        $album = Album::find($id);
        return strval($album->image);
    }

    public function getArtists($id){
        $album = Album::find($id);
        return $album->artists;
    }
}
