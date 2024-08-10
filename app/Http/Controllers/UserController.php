<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
        return view('admin');
        }
        return redirect()->route('welcome');
    }

}
