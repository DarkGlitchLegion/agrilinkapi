<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingPriceHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'product_listing_id' => 'required|exists:product_listings,id',
            'old_price' => 'required|numeric|min:0',
            'new_price' => 'required|numeric|min:0',
            'changed_by' => 'required|exists:users,id',

        ];
    }
}
