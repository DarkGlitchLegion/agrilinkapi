<?php

namespace App\Http\Requests\Geography;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'municipality_id' => 'required|exists:municipalities,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:barangays,code|max:50',
            'is_active' => 'boolean',

        ];
    }
}
