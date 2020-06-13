<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artist as Artist;
Use Redirect;
use Countries;
use DB;

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
        $this->validate($request,[
            'name' => 'required',
            'country' => 'required'
        ]);
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
        $artist = Artist::find($req->id);
        $artist->name = $req->name;
        $artist->country = $req->country;
        if ($artist->isDirty()) {
            $artist->save();
            return Redirect::back()->with('status', 'Artist Updated!');
        }
        else{
             return Redirect::back()->withErrors(['No changes detected.']);
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
        //
    }
}
