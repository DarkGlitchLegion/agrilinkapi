<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_listing_id' => 'sometimes|required|exists:product_listings,id',
            'storage_path' => 'sometimes|required|string',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'sometimes|integer',
            'uploaded_by' => 'sometimes|required|exists:users,id',
        ];
    }
}
