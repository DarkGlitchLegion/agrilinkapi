<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreFarmCropRequest extends FormRequest
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
            'cultivated_area_hectares' => 'required|numeric|min:0',
            'planting_date' => 'nullable|date',
            'expected_harvest_date' => 'nullable|date',
            'status' => 'string',

        ];
    }
}
