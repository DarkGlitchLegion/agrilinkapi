<?php

namespace App\Http\Requests\Identity;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|exists:users,id',
            'label' => 'sometimes|required|string|max:255',
            'address_line' => 'sometimes|required|string',
            'barangay_id' => 'sometimes|required|exists:barangays,id',
            'postal_code' => 'sometimes|required|string|max:20',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_default' => 'sometimes|boolean',
        ];
    }
}
