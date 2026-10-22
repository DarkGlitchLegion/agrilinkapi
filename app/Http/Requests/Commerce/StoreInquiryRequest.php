<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'buyer_user_id' => 'required|exists:users,id',
            'product_listing_id' => 'required|exists:product_listings,id',
            'requested_quantity' => 'required|numeric|min:0',
            'unit_id' => 'required|exists:units_of_measure,id',
            'message' => 'nullable|string',
            'status' => 'string',

        ];
    }
}
