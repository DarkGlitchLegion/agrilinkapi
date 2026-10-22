<?php

namespace App\Http\Requests\Buyers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBuyerProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|exists:users,id',
            'buyer_type' => 'sometimes|required|string',
            'display_name' => 'sometimes|required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'preferred_barangay_id' => 'nullable|exists:barangays,id',
            'verification_status' => 'sometimes|string',
        ];
    }
}
