<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommodityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'sometimes|required|exists:product_categories,id',
            'name' => 'sometimes|required|string|max:255',
            'slug' => ['sometimes', 'required', 'string', Rule::unique('commodities', 'slug')->ignore($this->route('commodity'))],
            'description' => 'nullable|string',
            'default_unit_id' => 'nullable|exists:units_of_measure,id',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
