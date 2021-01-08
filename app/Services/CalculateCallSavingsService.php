<?php


namespace App\Services;

use App\Http\Controllers\Validators\CalculateCallSavingsValidation;
use App\Models\Product;
use App\Models\TaxCall;

class CalculateCallSavingsService
{
    public function getCallSavings($data) : array
    {
        $productId = $data['product'];
        $areaCodeSource = $data['areaCodeSource'];
        $areaCodeDestiny = $data['areaCodeDestiny'];
        $minutes = $data['minutes'];

        $resultProduct = Product::find($productId);
        $taxCall = TaxCall::where('ddd_source_id', $areaCodeSource)->where('ddd_destiny_id', $areaCodeDestiny)->first();

        if (!$taxCall)
            throw new \DomainException("Não há valores disponíveis. Por favor, selecione outro DDD de destino e/ou origem");

        return $this->calculatesSavings($resultProduct,$taxCall,$minutes);
    }

    private function calculatesSavings($product, $taxCall, $minutes) : array
    {
        $productFreeMinutes = $product->free_minutes;
        $productTaxExtraMinute = $product->tax_extra_minute;
        $pricePerMinute = $taxCall->price_per_minute;

        $priceWithoutProduct = $pricePerMinute * $minutes;

        $diff = $minutes - $productFreeMinutes;
        if ($diff > 0)
            $priceWithProduct = $diff * ($pricePerMinute + ($pricePerMinute * $productTaxExtraMinute));
        else
            $priceWithProduct = 0.00;

        $saving = $priceWithoutProduct - $priceWithProduct;

        return [
            "priceWithProduct" => $priceWithProduct,
            "priceWithoutProduct" => $priceWithoutProduct,
            "saving" => $saving
        ];
    }
}
