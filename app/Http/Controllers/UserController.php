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

   public function addCart(Request $request){
        $id=$request->id;
        $product=Product::findOrFail($id);
        $data =[
            'createdBy' =>$product->createdBy,
            'price' => $product -> price,
            'name' =>$product -> name ,
            'user' => Auth::id(),
            'img' => $product -> profileImage,
       ];
        event(new newPanier($data));
        return response()->json([
            'status' => true,
            'msg' => 'product has been added to cart',
            'id' => $id
        ]);
    }
    
    public function carts(){
        return view('user.carts');
    }

}
