<?php

namespace App\Http\Requests\Identity;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPreferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|exists:users,id',
            'language' => 'sometimes|required|string|max:10',
            'preferred_notification_channel' => 'sometimes|required|string|max:50',
            'marketing_opt_in' => 'sometimes|boolean',
        ];
    }
}
