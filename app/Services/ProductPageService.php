<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;

class ProductPageService
{
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getProductPageData()
    {
        return [
            'products' => $this->productRepository->all(),
            'categories' => $this->categoryRepository->All(),
        ];
    }

    public function getProductsByCategory(?string $category, ?string $search)
    {
        return [
            'products'     => $this->productRepository->searchByCategoryAndName($category, $search),
            'categories'   => $this->categoryRepository->all(),
            'all_products' => $this->productRepository->all(),
            'categoryS'    => $category,
            'search'       => $search,
        ];
    }
}
