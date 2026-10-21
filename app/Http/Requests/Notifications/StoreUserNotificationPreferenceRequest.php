<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserNotificationPreferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'user_id' => 'required|exists:users,id',
            'email_enabled' => 'boolean',
            'sms_enabled' => 'boolean',
            'weather_alerts_enabled' => 'boolean',
            'price_alerts_enabled' => 'boolean',
            'program_alerts_enabled' => 'boolean',

        ];
    }
}
