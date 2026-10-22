<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class StoreConversationParticipantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'conversation_id' => 'required|exists:conversations,id',
            'user_id' => 'required|exists:users,id',

        ];
    }
}
