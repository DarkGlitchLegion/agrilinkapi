<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreBuyerProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'user_id' => 'required|exists:users,id',
            'buyer_type' => 'required|string',
            'display_name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'preferred_barangay_id' => 'nullable|exists:barangays,id',
            'verification_status' => 'string',

        ];
    }
}
