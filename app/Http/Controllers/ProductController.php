<?php

namespace App\Http\Controllers;

use App\API\ApiError;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $result = [];

        try {
            $result['data'] = $this->productService->getAll();
        }
        catch (\Exception $e) {
            return response()->json(ApiError::errorMessage($e->getMessage(), 500));
        }

        return response()->json($result,200);
    }
}
