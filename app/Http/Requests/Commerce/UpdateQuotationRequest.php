<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuotationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'inquiry_id' => 'sometimes|required|exists:inquiries,id',
            'farmer_user_id' => 'sometimes|required|exists:users,id',
            'unit_price' => 'sometimes|required|numeric|min:0',
            'quantity_offered' => 'sometimes|required|numeric|min:0',
            'unit_id' => 'sometimes|required|exists:units_of_measure,id',
            'valid_until' => 'sometimes|required|date',
            'terms' => 'nullable|string',
            'status' => 'sometimes|string',
        ];
    }
}
