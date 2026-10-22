<?php

namespace App\Http\Requests\Geography;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFarmCropRequest extends FormRequest
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
            'cultivated_area_hectares' => 'sometimes|required|numeric|min:0',
            'planting_date' => 'nullable|date',
            'expected_harvest_date' => 'nullable|date',
            'status' => 'sometimes|string',
        ];
    }
}
