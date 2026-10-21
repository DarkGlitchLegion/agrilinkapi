<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreKnowledgeArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'category_id' => 'required|exists:knowledge_categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:knowledge_articles,slug|max:255',
            'summary' => 'nullable|string',
            'body' => 'required|string',
            'language' => 'string',
            'author_user_id' => 'required|exists:users,id',
            'status' => 'string',

        ];
    }
}
