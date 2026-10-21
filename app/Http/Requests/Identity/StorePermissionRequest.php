<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:permissions,slug|max:255',
            'description' => 'nullable|string',

        ];
    }
}
