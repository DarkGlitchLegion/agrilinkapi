<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'sometimes|required|exists:orders,id',
            'product_listing_id' => 'sometimes|required|exists:product_listings,id',
            'product_name_snapshot' => 'sometimes|required|string',
            'quantity' => 'sometimes|required|numeric|min:0',
            'unit_id' => 'sometimes|required|exists:units_of_measure,id',
            'unit_price' => 'sometimes|required|numeric|min:0',
            'line_total' => 'sometimes|required|numeric|min:0',
        ];
    }
}
