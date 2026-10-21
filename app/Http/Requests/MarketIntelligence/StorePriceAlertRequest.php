<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StorePriceAlertRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'user_id' => 'required|exists:users,id',
            'commodity_id' => 'required|exists:commodities,id',
            'barangay_id' => 'nullable|exists:barangays,id',
            'target_price' => 'required|numeric|min:0',
            'comparison_operator' => 'required|string|in:lt,gt,eq',
            'is_active' => 'boolean',

        ];
    }
}
