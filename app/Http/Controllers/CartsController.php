<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Events\newPanier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=[];
        if(Auth::check()){
            $user = Auth::user();
            $products = $user->products; // Retrieve all products associated with the authenticated user
        }   
        // return view('user.carts',['Carts'=>$products]);
        return response()->json(['Carts'=>$products]);  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('cart.store');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id; 
            $id=$request->cart;
            $product=Product::findOrFail($id);
                // Use the attach method to associate the user with the product
            if(!($product->users_P()->where('user_id', $userId)->exists())){
                $product->users_P()->attach($userId);
                $data =[
                    'id' =>$product->id,
                    'createdBy' =>$product->createdBy,
                    'price' => $product -> price,
                    'name' =>$product -> name,
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
        }else {
            // User is not authenticated
            return response()->json([
                'status' => false,
                'msg' => 'User is not authenticated',
            ]);
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
        if (Auth::check()) {
            $user_id = Auth::user()->id; 

            if ($user_id) {
                // Detach the specified product from the user
                $user=User::findOrFail($user_id);
                $user->products()->detach($id);
                return response()->json(['message' => 'Record removed from pivot table','data' => $id], 200);
            } else {
                return response()->json(['error' => 'User not found'], 404);
            }
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'User is not authenticated',
            ]); 
        }
    }

    public function markItRead(Request $request)
    {
        $request->validate([
            'carts' => 'required|array',
            'carts.*.pivot.user_id' => 'required|integer|exists:users,id',
            'carts.*.pivot.product_id' => 'required|integer|exists:products,id',
        ]);
        $carts = $request->input('carts');
        foreach ($carts as $cartItem) {
            $userId = $cartItem['pivot']['user_id'];
            $productId = $cartItem['pivot']['product_id'];

            // Find the user
            $user = User::findOrFail($userId);

            // Update the pivot table
            $user->products()->updateExistingPivot($productId, ['isRead' => true]);
        }

        return response()->json(['message' => 'Cart items marked as read successfully.'], 200);
    }
}
