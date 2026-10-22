<?php

namespace App\Http\Requests\Knowledge;

use Illuminate\Foundation\Http\FormRequest;

class StoreKnowledgeCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'parent_id' => 'nullable|exists:knowledge_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:knowledge_categories,slug|max:255',
            'description' => 'nullable|string',

        ];
    }
}
