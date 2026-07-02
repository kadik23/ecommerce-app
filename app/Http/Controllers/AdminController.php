<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\WalletTransaction;


class AdminController extends Controller
{   
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    public function index()
    {
        $indexTitle = 'Sales Analytics'; // Set the title

        // (sum of order_payment transaction amounts)
        $totalRevenue = WalletTransaction::where('type', 'order_payment')->sum('amount');

        $totalProfits = $totalRevenue * 0.85;

        return view('admin.index', compact('indexTitle', 'totalRevenue', 'totalProfits'));
    }
    public function products()
    {
        return view('admin.products',['productsController' => Product::all()]);
    }
    public function orders()
    {   
        $orderTitle = 'Orders Management'; 
        $iconCard = ['priority', 'cancel', 'recommend', 'refresh'];
        $orderStat = ['completed', 'canceled', 'confirmed', 'pending'];
    
        // Count the number of orders for each state
        $nbr = [
            Order::where('state', 'complete')->count(),
            Order::where('state', 'cancel')->count(),
            Order::where('state', 'confirm')->count(),
            Order::where('state', 'pending')->count(),
        ];
    
        $orders = Order::with('product')->get();
        
        return view('admin.orders', compact('orderTitle', 'iconCard', 'nbr', 'orderStat', 'orders'));
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