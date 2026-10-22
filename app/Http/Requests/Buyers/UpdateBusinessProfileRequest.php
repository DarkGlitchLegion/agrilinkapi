<?php

namespace App\Http\Requests\Buyers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessProfileRequest extends FormRequest
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
            'buyer_profile_id' => 'sometimes|required|exists:buyer_profiles,id',
            'business_name' => 'sometimes|required|string|max:255',
            'business_type' => 'sometimes|required|string|max:255',
            'business_address' => 'sometimes|required|string',
            'business_email' => 'nullable|email',
            'business_phone' => 'nullable|string',
            'registration_reference' => 'nullable|string',
            'verification_status' => 'sometimes|string',
        ];
    }
}
