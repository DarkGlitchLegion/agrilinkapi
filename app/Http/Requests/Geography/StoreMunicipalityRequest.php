<?php

namespace App\Http\Requests\Geography;

use Illuminate\Foundation\Http\FormRequest;

class StoreMunicipalityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:municipalities,code|max:50',
            'is_active' => 'boolean',

        ];
    }
}
