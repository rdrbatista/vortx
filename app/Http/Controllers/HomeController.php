<?php

namespace App\Http\Controllers;

use App\Services\AreaCodeService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $productService = new ProductService();
        $products = $productService->getAll();

        $areaCodeService = new AreaCodeService();
        $areaCodes = $areaCodeService->getAll();

        return view ('index', compact('products','areaCodes'));
    }
}
