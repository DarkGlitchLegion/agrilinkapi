<?php

namespace App\Http\Requests\Buyers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessMemberRequest extends FormRequest
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
            'business_profile_id' => 'sometimes|required|exists:business_profiles,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'business_role' => 'sometimes|required|string|max:100',
            'status' => 'sometimes|string',
        ];
    }
}
