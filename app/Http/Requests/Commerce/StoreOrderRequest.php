<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'order_number' => 'required|string|unique:orders,order_number',
            'buyer_user_id' => 'required|exists:users,id',
            'farmer_user_id' => 'required|exists:users,id',
            'quotation_id' => 'nullable|exists:quotations,id',
            'delivery_method' => 'required|string',
            'subtotal' => 'required|numeric|min:0',
            'delivery_fee' => 'numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'currency' => 'string',
            'status' => 'string',

        ];
    }
}
