<?php

namespace App\Http\Requests\Geography;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFarmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'owner_user_id' => 'sometimes|required|exists:users,id',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'barangay_id' => 'sometimes|required|exists:barangays,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'area_hectares' => 'sometimes|required|numeric|min:0',
            'verification_status' => 'sometimes|string',
            'is_public' => 'sometimes|boolean',
        ];
    }
}
