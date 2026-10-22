<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListingReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_listing_id' => 'sometimes|required|exists:product_listings,id',
            'reporter_user_id' => 'sometimes|required|exists:users,id',
            'reason' => 'sometimes|required|string|max:255',
            'details' => 'nullable|string',
            'status' => 'sometimes|string',
        ];
    }
}
