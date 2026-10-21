<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPreferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'user_id' => 'required|exists:users,id',
            'language' => 'required|string|max:10',
            'preferred_notification_channel' => 'required|string|max:50',
            'marketing_opt_in' => 'boolean',

        ];
    }
}
