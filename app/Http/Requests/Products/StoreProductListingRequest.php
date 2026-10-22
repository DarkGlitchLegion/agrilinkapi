<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'farm_id' => 'required|exists:farms,id',
            'commodity_id' => 'required|exists:commodities,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'variety' => 'nullable|string',
            'quality_grade' => 'nullable|string',
            'quantity_available' => 'required|numeric|min:0',
            'unit_id' => 'required|exists:units_of_measure,id',
            'minimum_order_quantity' => 'numeric|min:0',
            'price_per_unit' => 'required|numeric|min:0',
            'pricing_type' => 'required|string',
            'harvest_date' => 'nullable|date',
            'available_until' => 'nullable|date',
            'status' => 'string',

        ];
    }
}
