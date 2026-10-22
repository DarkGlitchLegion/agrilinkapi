<?php

namespace App\Http\Requests\Knowledge;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKnowledgeArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'sometimes|required|exists:knowledge_categories,id',
            'title' => 'sometimes|required|string|max:255',
            'slug' => ['sometimes', 'required', 'string', Rule::unique('knowledge_articles', 'slug')->ignore($this->route('knowledge_article'))],
            'summary' => 'nullable|string',
            'body' => 'sometimes|required|string',
            'language' => 'sometimes|string',
            'author_user_id' => 'sometimes|required|exists:users,id',
            'status' => 'sometimes|string',
        ];
    }
}
