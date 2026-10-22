<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_number' => ['sometimes', 'required', 'string', Rule::unique('orders', 'order_number')->ignore($this->route('order'))],
            'buyer_user_id' => 'sometimes|required|exists:users,id',
            'farmer_user_id' => 'sometimes|required|exists:users,id',
            'quotation_id' => 'nullable|exists:quotations,id',
            'delivery_method' => 'sometimes|required|string',
            'subtotal' => 'sometimes|required|numeric|min:0',
            'delivery_fee' => 'sometimes|numeric|min:0',
            'total_amount' => 'sometimes|required|numeric|min:0',
            'currency' => 'sometimes|string',
            'status' => 'sometimes|string',
        ];
    }
}
