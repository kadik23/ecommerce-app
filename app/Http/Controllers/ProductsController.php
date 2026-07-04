<?php

namespace App\Http\Controllers;

use App\Traits\photos;
use App\Traits\orderBy;
use Illuminate\Http\Request;
use App\Services\ProductPageService;
use App\Http\Requests\ProductFilterRequest;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductsController extends Controller
{
    use photos;
    use orderBy;
    protected $productPageService;


    public function __construct(
        ProductPageService $productPageService,
        private ProductRepositoryInterface $productsRepository,
        private CategoryRepositoryInterface $categoriesRepository,
    ) {
        $this->productPageService = $productPageService;
    }

    public function index()
    {
        $categories = $this->categoriesRepository->all();
        $products = Product::paginate(12)->withQueryString();
        return view('admin.products', [
            'products' => $products,
            'categories' => $categories,
            'Categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addProduct', ['Categories' => $this->categoriesRepository->all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $fileName = $this->save_photo($request->file('image'), 'products');
            $data['profileImage'] = $fileName;
            unset($data['image']);
        }

        $data['createdBy'] = auth()->id();

        $this->productsRepository->create($data);

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductFilterRequest $request)
    {
        $category = $request->input('category');
        $search = $request->input('search');
        
        $query = Product::query();
        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }
        if (!empty($category) && $category !== 'All categories') {
            $query->where('category', $category);
        }
        
        $products = $query->paginate(6)->withQueryString();
        
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'products' => $products,
                'categoryS' => $category,
                'search' => $search
            ]);
        }

        $categories = $this->categoriesRepository->all();
        return view('admin.products', [
            'products' => $products,
            'categories' => $categories,
            'Categories' => $categories,
            'categoryS' => $category,
            'search' => $search
        ]);
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
    public function update(UpdateProductRequest $request, string $id)
    {
        $data = $request->validated();
        $productId = $data['idModal'];

        if (!empty($data['file_input'])) {
            $fileName = $this->save_photo($data['file_input'], 'products');
            $data['profileImage'] = $fileName;
            unset($data['file_input']);
        }

        $data['name'] = strip_tags($data['product']);
        $data['price'] = strip_tags($data['price']);
        unset($data['product'], $data['idModal']);

        $this->productsRepository->update($productId, $data);
        return redirect(route('dashboard.products'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $this->productsRepository->delete($id);
        return response()->json([
            'status' => true,
            'msg' => 'Product has been deleted successfully',
            'id' => $request->id
        ]);
    }

    public function filter(Request $request)
    {
        $query = Product::query();
        
        if ($request->filter === 'Available') {
            $query->where('quantity', '>', 0);
        } elseif ($request->filter === 'LowToHigh') {
            $query->orderBy('price', 'asc');
        } elseif ($request->filter === 'HighToLow') {
            $query->orderBy('price', 'desc');
        }
        
        $products = $query->paginate(6)->withQueryString();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($products);
        }

        $categories = $this->categoriesRepository->all();
        return view('admin.products', [
            'products' => $products,
            'categories' => $categories,
            'Categories' => $categories
        ]);
    }
}