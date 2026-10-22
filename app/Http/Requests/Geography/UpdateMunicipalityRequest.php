<?php

namespace App\Http\Requests\Geography;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMunicipalityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'province_id' => 'sometimes|required|exists:provinces,id',
            'name' => 'sometimes|required|string|max:255',
            'code' => ['sometimes', 'required', 'string', Rule::unique('municipalities', 'code')->ignore($this->route('municipality'))],
            'is_active' => 'sometimes|boolean',
        ];
    }
}
