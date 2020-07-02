<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Redirect;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = DB::table('roles')->get();

        return view('users',compact('users','roles'));
    }

     private function getAddValidator($request){
        $validator =  Validator::make($request->all(),[
            'name' => 'required',
            'role' => "required",
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
    public function update(Request $req)
    {   
        $validator = $this->getAddValidator($req);
        $validator->validate();
    
        $user = User::find($req->id);
        $role = DB::table('roles')->where('id', $req->role)->get()->first();
        $user->name = $req->name;

        $user->syncRoles([$role->name]);
        $user->save();

        return Redirect::back()->with('status', 'User Updated!');
        
    }
}
