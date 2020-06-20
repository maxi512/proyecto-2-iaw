<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use DB;
use Redirect;
use App\Artist;

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

    private function areRepeatedElements($array){
        return count(array_unique($array))<count($array);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $this->validate($request,[
            'name' => 'required',
            'artists' => "required|array|min:1",
            'artists.*'=> "required|distinct",
            'cover' => 'required|mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);

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

    public function getCover($id){
        $album = Album::find($id);
        return response()->make($album->image, 200, array(
        'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($album->image)
        ));
    
    }

    public function allAlbums(){
        return Album::all();
    }
}
