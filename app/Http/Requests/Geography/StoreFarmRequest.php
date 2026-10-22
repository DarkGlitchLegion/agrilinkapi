<?php

namespace App\Http\Requests\Geography;

use Illuminate\Foundation\Http\FormRequest;

class StoreFarmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'owner_user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'barangay_id' => 'required|exists:barangays,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'area_hectares' => 'required|numeric|min:0',
            'verification_status' => 'string',
            'is_public' => 'boolean',

        ];
    }
}
