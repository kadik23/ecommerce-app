<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->hasRole('admin')) {
            return redirect('/dashboard'); // Replace '/admin' with your admin route
        } elseif (Auth::user()->hasRole('user')) {
            return redirect('/user'); // Replace '/user' with your user route
        }
        return view('home');
    }
}
