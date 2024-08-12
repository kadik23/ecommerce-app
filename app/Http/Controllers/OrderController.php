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
        return response()->json(['Orders'=>Order::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('order.store');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.quantity' => 'required|integer|min:1',
            'orders.*.orderBy' => 'required|exists:users,id',
            'orders.*.Product' => 'required|exists:products,id',
            'orders.*.paymentMethod' => 'required|string',
            'orders.*.deliveryMethod' => 'required|string',
        ]);
        $user = $request->user();
        foreach ($request->orders as $orderData) {
            Order::create([
                'quantity' => $orderData['quantity'],
                'orderBy' => $orderData['orderBy'],
                'productOrdered' => $orderData['Product'],
                'paymentMethod' => $orderData['paymentMethod'],
                'deliveryMethod' => $orderData['deliveryMethod'],
                'dateOrder' => now(),
            ]);
            $user->products()->detach($orderData['Product']);
        }

        return response()->json(['message' => 'Order(s) placed successfully', 'status' => 201], 201);
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

    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->state = $request->status;
            $order->save();

            return response()->json(['success' => true, 'message' => 'Order status updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Order not found'], 404);
    }
}
