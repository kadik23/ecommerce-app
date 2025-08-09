<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductPageService;

class HomeController extends Controller
{
    protected $productPageService;

    public function __construct(ProductPageService $productPageService)
    {
        $this->productPageService = $productPageService;
    }
    public function index()
    {
        $data = $this->productPageService->getProductPageData();

        return response()->json($data);
    }
}
