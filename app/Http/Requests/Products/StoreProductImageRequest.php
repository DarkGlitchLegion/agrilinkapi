<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'product_listing_id' => 'required|exists:product_listings,id',
            'storage_path' => 'required|string',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'integer',
            'uploaded_by' => 'required|exists:users,id',

        ];
    }
}
