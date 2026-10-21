<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreBuyerProductRequirementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'buyer_profile_id' => 'required|exists:buyer_profiles,id',
            'commodity_id' => 'required|exists:commodities,id',
            'quantity_required' => 'required|numeric|min:0',
            'unit_id' => 'required|exists:units_of_measure,id',
            'target_price' => 'nullable|numeric|min:0',
            'needed_by' => 'nullable|date',
            'delivery_barangay_id' => 'nullable|exists:barangays,id',
            'status' => 'string',

        ];
    }
}
