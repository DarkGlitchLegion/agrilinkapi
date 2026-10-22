<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'order_id' => 'required|exists:orders,id',
            'product_listing_id' => 'required|exists:product_listings,id',
            'product_name_snapshot' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            'unit_id' => 'required|exists:units_of_measure,id',
            'unit_price' => 'required|numeric|min:0',
            'line_total' => 'required|numeric|min:0',

        ];
    }
}
