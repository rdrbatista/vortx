<?php

namespace App\Http\Controllers;

use App\API\ApiError;
use App\Services\AreaCodeService;
use Illuminate\Http\Request;

class AreaCodeController extends Controller
{
    private $areaCodeService;

    public function __construct(AreaCodeService $areaCodeService)
    {
        $this->areaCodeService = $areaCodeService;
    }

    public function index()
    {
        $result = [];

        try {
            $result['data'] = $this->areaCodeService->getAll();
        }
        catch (\Exception $e) {
            return response()->json(ApiError::errorMessage($e->getMessage(), 500));
        }

        return response()->json($result,200);
    }
}
