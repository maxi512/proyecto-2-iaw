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
            'cover' => 'required|mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);
        
        $validator->after(function($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('addError', 'No changes on store.');
            }
        });
        
        $validator->validate();

        $file = $request->file('cover');
        $content = $file->openFile()->fread($file->getSize());

        $album = new Album;
        $album->name = $request->name;
        $album->image = base64_encode($content);

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
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function allAlbums(){
        return Album::all();
    }

    public function albumsFromList(Request $request){
        $collection = collect([]);
        foreach($request->artists as $artist){
            $collection = $collection->merge(Artist::find($artist)->albums->toArray());
        }
        return $collection->unique()->values()->all();
    }

    public function getCover($id){
        $album = Album::find($id);
        
        return strval($album->image);
    }
}
