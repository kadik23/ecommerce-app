<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Events\newPanier;
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
        if(Auth::user()->hasRole('admin')){
        return view('admin');
        }
        return redirect()->route('welcome');
    }
    public function myorders(){
        return view('user.myOrders');
    }
    public function paymentmethod(){
        return view('user.paymentMethod');
    }
}
