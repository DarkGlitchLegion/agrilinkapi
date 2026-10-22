<?php

namespace App\Http\Requests\Buyers;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusinessMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'business_profile_id' => 'required|exists:business_profiles,id',
            'user_id' => 'required|exists:users,id',
            'business_role' => 'required|string|max:100',
            'status' => 'string',

        ];
    }
}
