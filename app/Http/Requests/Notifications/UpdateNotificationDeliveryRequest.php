<?php

namespace App\Http\Requests\Notifications;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationDeliveryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'notification_reference' => 'sometimes|required|string',
            'user_id' => 'sometimes|required|exists:users,id',
            'channel' => 'sometimes|required|string',
            'provider_reference' => 'nullable|string',
            'status' => 'sometimes|string',
        ];
    }
}
