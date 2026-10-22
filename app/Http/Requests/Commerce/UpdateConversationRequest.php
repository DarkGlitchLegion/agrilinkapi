<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConversationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'created_by' => 'sometimes|required|exists:users,id',
            'subject' => 'nullable|string|max:255',
            'conversation_type' => 'sometimes|required|string',
            'status' => 'sometimes|string',
        ];
    }
}
