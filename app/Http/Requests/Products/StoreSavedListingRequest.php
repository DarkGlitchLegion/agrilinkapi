<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreSavedListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'user_id' => 'required|exists:users,id',
            'product_listing_id' => 'required|exists:product_listings,id',

        ];
    }
}
