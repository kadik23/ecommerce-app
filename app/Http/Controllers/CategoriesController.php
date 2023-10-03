<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\photos;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use photos;
    public function index()
    {
        return view('admin.products');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addCategory');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('icon')) {
           
                $request->validate([
                    'icon' => 'required|image|mimes:svg,png|max:2048','category'=>['required '], 
                ]);
                // save photo in folder
                $file_name = $this->save_photo($request->icon,'categories');


                $request->validate([  
                    
                ]);//validate data before store it in data base
                $category = new Category() ;  
                $category->name =strip_tags( $request->input('category'));
                $category->icon= $file_name;        
                $category->save();
                return redirect()->route('product.index');
            
        }else{
          return back()->withErrors([
                'message' => 'Please upload an icon first.',
            ])->withInput();
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
