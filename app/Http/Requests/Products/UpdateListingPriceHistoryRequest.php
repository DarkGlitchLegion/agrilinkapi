<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListingPriceHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_listing_id' => 'sometimes|required|exists:product_listings,id',
            'old_price' => 'sometimes|required|numeric|min:0',
            'new_price' => 'sometimes|required|numeric|min:0',
            'changed_by' => 'sometimes|required|exists:users,id',
        ];
    }
}
