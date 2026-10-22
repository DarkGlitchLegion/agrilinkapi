<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class StoreConversationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'created_by' => 'required|exists:users,id',
            'subject' => 'nullable|string|max:255',
            'conversation_type' => 'required|string',
            'status' => 'string',

        ];
    }
}
