<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommodityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:commodities,slug|max:255',
            'description' => 'nullable|string',
            'default_unit_id' => 'nullable|exists:units_of_measure,id',
            'is_active' => 'boolean',

        ];
    }
}
