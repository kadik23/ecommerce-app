<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('rate.store');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            $validated = $request->validate([
                'productId' => 'required|exists:products,id',
                'rating' => 'required|integer|min:1|max:5',
            ]);
    
            $product = Product::find($validated['productId']);
            $product->ratings()->create([
                'rating' => $validated['rating'],
                'user_id' => auth()->id(),
            ]);
    
            return response()->json(['message' => 'Rating saved successfully']);
        }
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
