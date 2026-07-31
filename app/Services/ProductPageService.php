<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\SliderRepositoryInterface;

class ProductPageService
{
    protected $productRepository;
    protected $categoryRepository;
    protected $sliderRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        SliderRepositoryInterface $sliderRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->sliderRepository = $sliderRepository;
    }

    public function getProductPageData()
    {
        return [
            'products' => $this->productRepository->all(),
            'categories' => $this->categoryRepository->All(),
            'sliders' => $this->sliderRepository->all(),
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
