<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConversationParticipantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'conversation_id' => 'sometimes|required|exists:conversations,id',
            'user_id' => 'sometimes|required|exists:users,id',
        ];
    }
}
