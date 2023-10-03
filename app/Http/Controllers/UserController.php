<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:user');
    }

    public function index()
    {
        return view('user.index');
//         if(Auth::user()->hasRole('user')){
//             return view('user');
//        }elseif(Auth::user()->hasRole('admin')){
//         return view('admin');
//    }
    }
    // public function myprofile(){
    //     return view('user.profile');
    // }
}
