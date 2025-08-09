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
        $data = $this->productPageService->getProductPageData();
        return view('admin.products', $data);
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
        $data['sold'] = 0;

        $this->productsRepository->create($data);

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductFilterRequest $request)
    {
        $data = $this->productPageService->getProductsByCategory(
            $request->input('category'),
            $request->input('search')
        );

        return response()->json($data);
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
        return redirect(route('product.index'));
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
        return match ($request->filter) {
            "Best selling" => $this->getTavlesByColumn('price', 'asc', 'Product'),
            "Available" => $this->productsRepository->where('quantity', '>', 0),
            "LowToHigh" => $this->productsRepository->orderBy('price', 'asc'),
            "HighToLow" => $this->productsRepository->orderBy('price', 'desc'),
            default => $this->productsRepository->all(),
        };
    }
}
