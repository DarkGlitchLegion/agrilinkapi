<?php

namespace App\Http\Requests\MarketIntelligence;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceAlertRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|exists:users,id',
            'commodity_id' => 'sometimes|required|exists:commodities,id',
            'barangay_id' => 'nullable|exists:barangays,id',
            'target_price' => 'sometimes|required|numeric|min:0',
            'comparison_operator' => 'sometimes|required|string|in:lt,gt,eq',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
