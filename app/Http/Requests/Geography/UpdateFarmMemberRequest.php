<?php

namespace App\Http\Requests\Geography;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFarmMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'farm_id' => 'sometimes|required|exists:farms,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'membership_role' => 'sometimes|required|string|max:100',
            'status' => 'sometimes|string',
            'invited_by' => 'nullable|exists:users,id',
        ];
    }
}
