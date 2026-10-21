<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitOfMeasureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:20',
            'unit_type' => 'required|string|max:50',
            'is_active' => 'boolean',

        ];
    }
}
