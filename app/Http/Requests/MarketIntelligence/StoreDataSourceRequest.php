<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataSourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => 'required|string|max:255',
            'source_type' => 'required|string',
            'source_url' => 'nullable|url',
            'publisher' => 'nullable|string',
            'license_notes' => 'nullable|string',
            'is_active' => 'boolean',

        ];
    }
}
