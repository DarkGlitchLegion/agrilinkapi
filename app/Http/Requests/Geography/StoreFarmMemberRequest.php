<?php

namespace App\Http\Requests\Geography;

use Illuminate\Foundation\Http\FormRequest;

class StoreFarmMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'farm_id' => 'required|exists:farms,id',
            'user_id' => 'required|exists:users,id',
            'membership_role' => 'required|string|max:100',
            'status' => 'string',
            'invited_by' => 'nullable|exists:users,id',

        ];
    }
}
