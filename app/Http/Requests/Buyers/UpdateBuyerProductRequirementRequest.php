<?php

namespace App\Http\Requests\Buyers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBuyerProductRequirementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'buyer_profile_id' => 'sometimes|required|exists:buyer_profiles,id',
            'commodity_id' => 'sometimes|required|exists:commodities,id',
            'quantity_required' => 'sometimes|required|numeric|min:0',
            'unit_id' => 'sometimes|required|exists:units_of_measure,id',
            'target_price' => 'nullable|numeric|min:0',
            'needed_by' => 'nullable|date',
            'delivery_barangay_id' => 'nullable|exists:barangays,id',
            'status' => 'sometimes|string',
        ];
    }
}
