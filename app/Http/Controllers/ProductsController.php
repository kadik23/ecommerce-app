<?php

namespace App\Http\Controllers;

use App\Traits\photos;
use App\Models\Product;
use App\Traits\orderBy;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{   
    use photos;
    use orderBy;
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            return view('admin.products',['productsController' => Product::all(),'Categories'=>Category::all(),'Products'=> Product::all()]);
        } else {
            return response()->json(['productsController' => Product::all(),'Categories'=>Category::all(),'Products'=> Product::all()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Create an instance of CategoryController
        $categoryController = new CategoriesController();
        
        $categoriesResponse = $categoryController->getAll();
        
        return view('admin.addProduct',['Categories'=>$categoriesResponse]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        if ($request->hasFile('image')) {
            if (Auth::check()) {
                $admin = Auth::user();
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust validation rules as needed
                ]);

                $file_name = $this->save_photo($request->image,'products');
                $request->validate([  
                    'name'=>['required '],
                    'category'=>'required',
                    'price'=>'required',
                    'qnt'=>'required'
                ]);//validate data before store it in data base
                $product = new Product() ;  
                $product->name =strip_tags( $request->input('name'));
                $product->price = strip_tags($request->input('price'));
                $product->category = strip_tags($request->input('category'));
                $product->sold = 0;
                $product->profileImage= $file_name;
                // $product->profileImage = strip_tags($request->input('image'));
                $product->description = strip_tags($request->input('description'));
                $product->quantity = strip_tags($request->input('qnt'));
                $product->createdBy = $admin->id;
                $product->save();
                return redirect()->route('product.index');
            }
        }else{
            return back()->withErrors([
                'message' => 'Please upload an image first.',
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request ,string $category)
    {   
        $productSearch=$request->input('search');
        $categorySelected=$request->input('category');
        $category=$categorySelected;
        if($productSearch!==''){
            $products = Product::where('name', 'like', "%{$productSearch}%")->get();
            if($categorySelected=='All categories'){
                if($products->isEmpty()){
                    return response()->json([
                        'product' => $productSearch,
                        'productsController'=>[], 
                        'Categories' => Category::all(),
                        'Products' => Product::all(),
                        'categoryS'=>$categorySelected,
                    ]);
                }
                return response()->json([
                    'productsController' => $products, 
                    'Categories' => Category::all(),
                    'Products' => Product::all(),
                    'categoryS'=>$categorySelected
                ]);
            }

            $filteredProducts = $products->filter(function ($product) use ($categorySelected) {
                return $product->category === $categorySelected;
            });  
            if($filteredProducts->isEmpty()){
                return response()->json( [
                    'product' => $productSearch,
                    'productsController'=>[], 
                    'Categories' => Category::all(),
                    'Products' => Product::all(),
                    'categoryS'=>$categorySelected,
                ]);  
            } 
            return response()->json( [
                'productsController' => $filteredProducts,
                'cat'=>$categorySelected, 
                'Categories' => Category::all(),
                'Products' => Product::all(),
                'categoryS'=>$categorySelected
            ]);
        
        }else{
            $products =Product::where('category', $category)->with('category')->get();
            return response()->json([
                'productsController' => $products,
                'Categories'=>Category::all(),
                'Products' => Product::all(),
                'categoryS'=>$categorySelected,
            ]);
        }
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
        $request->validate(['product'=>'required','price'=>'required']);
        $idModal=$request->input('idModal');
        $product_update=Product::findOrFail($idModal); 
        if ($request->hasFile('file_input')) {
            $request->validate([
                'file_input' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $file_name = $this->save_photo($request->file_input,'products');
            $product_update->profileImage=$file_name;

        }

        $product_update->name=strip_tags($request->input('product'));
        $product_update->price=strip_tags($request->input('price'));
        $product_update->save();
        return redirect(route('product.index'));
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $product_delete = Product::findOrFail($request->id);  
        $product_delete->delete();
        // return redirect()->route('product.index'); 
        return response()->json([
            'status' => true,
            'msg' => 'Product has been deleted successfully',
            'id' =>  $request -> id
        ]);
 
    }

    public function byCategory(Request $request){
            $productSearch=$request->input('search');
            $categorySelected=$request->input('category');
            $category=$categorySelected;
            if($productSearch!==''){
                $products = Product::where('name', 'like', "%{$productSearch}%")->get();
                if($categorySelected=='All categories'){
                    if($products->isEmpty()){
                        return response()->json( [
                            'product' => $productSearch,
                            'productsController'=>[], 
                            'Categories' => Category::all(),
                            'Products' => Product::all(),
                            'categoryS'=>$categorySelected,
                        ]);  
                    } 
                    return response()->json([
                        'productsController' => $products, 
                        'Categories' => Category::all(),
                        'Products' => Product::all(),
                        'categoryS'=>$categorySelected
                    ]);
                }
                $filteredProducts = $products->filter(function ($product) use ($categorySelected) {
                    return $product->category === $categorySelected;
                });  
                if($filteredProducts->isEmpty()){
                    return response()->json( [
                        'product' => $productSearch,
                        'productsController'=>[], 
                        'Categories' => Category::all(),
                        'Products' => Product::all(),
                        'categoryS'=>$categorySelected,
                    ]);  
                } 
                return response()->json( [
                    'productsController' => $filteredProducts,
                    'cat'=>$categorySelected, 
                    'Categories' => Category::all(),
                    'Products' => Product::all(),
                    'categoryS'=>$categorySelected
                ]);
            }else{
                $products =Product::where('category', $category)->with('category')->get();
                return response()->json([
                    'productsController' => $products,
                    'Categories'=>Category::all(),
                    'Products' => Product::all(),
                    'categoryS'=>$categorySelected,
                ]);
            }
    }
    
    public function product_show(Request $request ,string $category){
        // return view('user.productsByCategory');
    }

    public function filter(Request $request){
        $filter= $request->filter;
        $products=Product::all();
        if($filter=="Best selling"){
            $products=$this->getTavlesByColumn('price','asc','Product');
        }elseif($filter=="Available"){
            $products=Product::where('quantity', '>', 0)->get();
        }elseif($filter=="LowToHigh"){
            $products= Product::orderBy('price', 'asc')->get();
        }elseif($filter=="HighToLow"){
            $products= Product::orderBy('price', 'desc')->get();
        }
        return response()->json([
            'productsController' => $products,
            'Categories'=>Category::all(),
            'Products' => Product::all(),
            'filter' => $filter,
        ]);
    }
}
