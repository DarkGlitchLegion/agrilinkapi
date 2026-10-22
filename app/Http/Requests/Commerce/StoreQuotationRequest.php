<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuotationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'inquiry_id' => 'required|exists:inquiries,id',
            'farmer_user_id' => 'required|exists:users,id',
            'unit_price' => 'required|numeric|min:0',
            'quantity_offered' => 'required|numeric|min:0',
            'unit_id' => 'required|exists:units_of_measure,id',
            'valid_until' => 'required|date',
            'terms' => 'nullable|string',
            'status' => 'string',

        ];
    }
}
