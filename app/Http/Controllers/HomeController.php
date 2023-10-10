<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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

    public function welcome(){
        return view('welcome',['productsController' => Product::all(),'categories'=>Category::all()]);   
 
    }
}
