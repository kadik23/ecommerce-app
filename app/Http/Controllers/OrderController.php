<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.myOrders',['Orders'=>Order::all()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = auth()->user()->id; 
        $new_order = new Order();
        $new_order->orderBy = $userId;
        $new_order->productOrdered = $request->input('productId');
        $quantityTotal = $request->input('hidden');
        $cartValues = [];
        $productIDs = [];
        foreach ($request->all() as $key => $value) {
            // Check if the key starts with 'hidden' to identify hidden inputs
            if (strpos($key, 'hidden') === 0) {
                $cartId = substr($key, 6); // Extract Cart ID from the key
                $cartValues[$cartId] = $value;
                array_push($productIDs, $cartId);

            }
        }
        $quantityTotal = array_sum($cartValues);
        $new_order->quantity = $quantityTotal;
        $new_order->deliveryMethod = 'deliveryMethod';
        $new_order->paymentMethod = 'paymentMethod';
        $currentDate = date('Y-m-d'); 
        $currentTime = date('H:i:s');
        $new_order->state = "processing ";
        $new_order->dateOrder =  $currentDate." ".$currentTime;
        $new_order->save();
        foreach( $productIDs as $productID ) {
            $product=Product::findOrFail($productID);
            // if (!($product->users_P()->where('user_id', $userId)->exists())) {
                $product->users_P()->detach($userId);
            // }
        }
        return redirect()->route("myorders");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
