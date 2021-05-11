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
        return view('home');
    }

    public function subadmin()
    {
        return view('home');
    }

    public function principal()
    {
        return view('home');
    }

    public function hod()
    {
        return view('home');
    }

    public function faculty()
    {
        return view('home');
    }
}
