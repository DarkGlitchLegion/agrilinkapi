<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_id' => 'nullable|exists:product_categories,id',
            'name' => 'sometimes|required|string|max:255',
            'slug' => ['sometimes', 'required', 'string', Rule::unique('product_categories', 'slug')->ignore($this->route('product_category'))],
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
