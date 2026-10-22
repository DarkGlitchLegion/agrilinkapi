<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'conversation_id' => 'sometimes|required|exists:conversations,id',
            'sender_user_id' => 'sometimes|required|exists:users,id',
            'message_body' => 'sometimes|required|string',
            'attachment_path' => 'nullable|string',
        ];
    }
}
