<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'conversation_id' => 'required|exists:conversations,id',
            'sender_user_id' => 'required|exists:users,id',
            'message_body' => 'required|string',
            'attachment_path' => 'nullable|string',

        ];
    }
}
