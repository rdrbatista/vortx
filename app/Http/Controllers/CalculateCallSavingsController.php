<?php

namespace App\Http\Controllers;

use App\API\ApiError;
use App\Http\Requests\CalculateSavingsRequest;
use App\Services\CalculateCallSavingsService;
use Illuminate\Http\Request;

class CalculateCallSavingsController extends Controller
{
    private $calculateCallSavingsService;

    public function __construct(CalculateCallSavingsService $calculateCallSavingsService)
    {
        $this->calculateCallSavingsService = $calculateCallSavingsService;
    }

    public function getCallSavings(CalculateSavingsRequest $request)
    {
        $data = $request->all();
        $result = [];

        try {
            $result['data'] = $this->calculateCallSavingsService->getCallSavings($data);
        }
        catch (\DomainException $dExc) {
            return response()->json(ApiError::errorMessage($dExc->getMessage(), 500),400);
        } catch (\Exception $e) {
            return response()->json(ApiError::errorMessage($e->getMessage(), 500),500);
        }

        return response()->json($result,200);
    }
}
