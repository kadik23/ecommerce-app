<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\Component\admin;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{   
    // public function __construct()
    // {
    //     $this->middleware('role:admin');
    // }
    public function index()
    {
        $indexTitle = 'Sales Analytics'; // Set the title
        // return view('admin.index', compact('indexTitle'));
        return response()->json(['compact'=>'indexTitle']);
    }
    public function products()
    {
        return view('admin.products',['productsController' => Product::all()]);
    }
    public function orders()
    {   
        $orderTitle = 'Orders Management'; // Set the title
        $iconCard=['priority','cancel','recommend','refresh'];
        $nbr=[370,23,3600,12];
        $orderStat=['Completed','Canceled','Confirmed','Refunded'];

        $state = 'CANCELED'; // Replace with the actual value of $state

        // Calculate the color based on $state
        if ($state === 'CANCELED') {
            $color = 'red';
        } elseif ($state === 'COMPLETED') {
            $color = 'blue';
        } elseif ($state === 'REFUNDED') {
            $color = 'black';
        } elseif ($state === 'CONFIRMED') {
            $color = 'blue';
        } else {
            $color = 'default-color'; // Default color if none of the conditions match
        }   
        
        return view('admin.orders', compact('orderTitle','iconCard','nbr','orderStat','state','color'));

    }

    public function customers(){
        $customersTitle='Customers';
        $iconCard=['group','flag','public','shopping_cart'];
        $nbr=[3600,23,370,12];
        $cardName=['All','Local','World','Shopping Cart'];
        return view('admin.Customers',compact('customersTitle','iconCard','nbr','cardName'));
    }
    // public function myprofile(){
    //     return view('admin.profile');
    // }
    

}
