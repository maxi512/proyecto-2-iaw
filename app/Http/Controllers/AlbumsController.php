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

    /**
     * Encodes a file to Base64
     */
    private function fileToBase64($file){
        $content = $file->openFile()->fread($file->getSize());
        return base64_encode($content);
    }

    /**
     * Returns a validator for adding request
     */
    private function getAddValidator($request){
        $validator =  Validator::make($request->all(),[
            'name' => 'required',
            'artists' => "required|array|min:1",
            'artists.*'=> "required|distinct",
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
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
        $album->year = $request->year;

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
    
    /**
     * Returns a validator for updating request
     */
    private function getUpdateValidator($request){
        $validator =  Validator::make($request->all(),[
            'name' => 'required',
            'artists' => "required|array|min:1",
            'artists.*'=> "required|distinct",
            'year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'cover' => "nullable|mimes:jpeg,jpg,png,gif|max:10000"
        ]);

        $validator->after(function($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('updateAlbumError', 'No changes on update.');
            }
        });

        return $validator;
    }

    /**
     * Return true if the artists are in the album
     * Return false otherwise
     */
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
        $album->year = $request->year;

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
            return Redirect::back()->with('successUpdateAlbum', 'Album Updated!');
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

    /**
     * Returns a collection of albums whose artists are in the requests
     */
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

    /**
     * Return the cover in Base64 of an album
     */
    public function getCover($id){
        $album = Album::find($id);
        return strval($album->image);
    }

    /**
     * Returns the artists of an albums
     */
    public function getArtists($id){
        $album = Album::find($id);
        return $album->artists;
    }
}
