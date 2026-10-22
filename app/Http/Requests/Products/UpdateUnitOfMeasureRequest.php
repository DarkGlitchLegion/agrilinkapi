<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitOfMeasureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'symbol' => 'sometimes|required|string|max:20',
            'unit_type' => 'sometimes|required|string|max:50',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
