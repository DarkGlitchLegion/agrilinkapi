<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'farm_id' => 'sometimes|required|exists:farms,id',
            'commodity_id' => 'sometimes|required|exists:commodities,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'variety' => 'nullable|string',
            'quality_grade' => 'nullable|string',
            'quantity_available' => 'sometimes|required|numeric|min:0',
            'unit_id' => 'sometimes|required|exists:units_of_measure,id',
            'minimum_order_quantity' => 'sometimes|numeric|min:0',
            'price_per_unit' => 'sometimes|required|numeric|min:0',
            'pricing_type' => 'sometimes|required|string',
            'harvest_date' => 'nullable|date',
            'available_until' => 'nullable|date',
            'status' => 'sometimes|string',
        ];
    }
}
