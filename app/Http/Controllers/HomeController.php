<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {      
        //Assign a Role if an user is new
        if(auth()->user()->roles()->count() == 0){
            auth()->user()->assignRole('Fan'); 
        }
        return view('home');
    }
}
