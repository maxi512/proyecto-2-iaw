<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artist as Artist;
Use Redirect;
use Countries;
use DB;
use Validator;

class ArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Countries::getList();
        $artists = DB::table('artists')->get();
        return view('artists',compact('artists','countries'));
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
            'country' => 'required'
        ]);
        
        $validator->after(function($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('addError', 'No changes on store.');
            }
        });
        $validator->validate();

        $artist = new Artist;
        $artist->name = $request->name;
        $artist->country = $request->country;
        $artist->save();
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
    public function update(Request $req)
    {   
        $validator =  Validator::make($req->all(),[
            'name' => 'required',
            'country' => 'required'
        ]);
        
        $validator->after(function($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('updateError', 'updateError');
            }
        });
        $validator->validate();

        $artist = Artist::find($req->id);
        $artist->name = $req->name;
        $artist->country = $req->country;

        $artist->save();
        return Redirect::back()->with('status', 'Artist Updated!');
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    
        $artist = Artist::find($id);
        $artist->delete();
        return Redirect::back()->with('status', 'Artist Deleted!');
    }

    public function getAlbums($id){
        $artist = Artist::find($id);
        return $artist->albums;
    }

    public function getArtists(){
        return Artist::all();
    }
}
