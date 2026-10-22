<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'buyer_user_id' => 'sometimes|required|exists:users,id',
            'product_listing_id' => 'sometimes|required|exists:product_listings,id',
            'requested_quantity' => 'sometimes|required|numeric|min:0',
            'unit_id' => 'sometimes|required|exists:units_of_measure,id',
            'message' => 'nullable|string',
            'status' => 'sometimes|string',
        ];
    }
}
