<?php

namespace App\Http\Requests\Buyers;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusinessProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'buyer_profile_id' => 'required|exists:buyer_profiles,id',
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'business_address' => 'required|string',
            'business_email' => 'nullable|email',
            'business_phone' => 'nullable|string',
            'registration_reference' => 'nullable|string',
            'verification_status' => 'string',

        ];
    }
}
