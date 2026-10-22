<?php

namespace App\Http\Requests\Notifications;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserNotificationPreferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|exists:users,id',
            'email_enabled' => 'sometimes|boolean',
            'sms_enabled' => 'sometimes|boolean',
            'weather_alerts_enabled' => 'sometimes|boolean',
            'price_alerts_enabled' => 'sometimes|boolean',
            'program_alerts_enabled' => 'sometimes|boolean',
        ];
    }
}
