<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFilterRequest;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Services\ProductPageService;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productsRepository,
        private CategoryRepositoryInterface $categoriesRepository,
        private ProductPageService $productPageService
    ) {}

    public function index(ProductFilterRequest $request)
    {
        return response()->json(
            $this->productsRepository->all($request->only(['category_id', 'search']))
        );
    }

    public function byCategory(ProductFilterRequest $request)
    {
        return response()->json(
            $this->productPageService->getProductsByCategory(
                $request->input('category'),
                $request->input('search')
            )
        );
    }
}
