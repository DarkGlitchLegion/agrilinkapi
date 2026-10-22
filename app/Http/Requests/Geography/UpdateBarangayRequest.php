<?php

namespace App\Http\Requests\Geography;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBarangayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'municipality_id' => 'sometimes|required|exists:municipalities,id',
            'name' => 'sometimes|required|string|max:255',
            'code' => ['sometimes', 'required', 'string', Rule::unique('barangays', 'code')->ignore($this->route('barangay'))],
            'is_active' => 'sometimes|boolean',
        ];
    }
}
