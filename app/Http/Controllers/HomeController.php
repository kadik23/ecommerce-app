<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    // use AuthenticatesUsers;


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(Auth::user()){
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin');
            }
        }
        return $this->welcome();
    }

    public function welcome(){
        $products=[];
        if(Auth::check()){
            $user = Auth::user();
            $products = $user->products; // Retrieve all products associated with the authenticated user
        }
        // return view('welcome',['productsController' => Product::all(),'Categories'=>Category::all(),'Carts'=>$products]);   
        return response()->json(['productsController' => Product::all(),'Categories'=>Category::all(),'Carts'=>$products]);
    }
}
