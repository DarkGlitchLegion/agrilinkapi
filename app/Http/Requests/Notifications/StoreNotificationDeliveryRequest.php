<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationDeliveryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'notification_reference' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'channel' => 'required|string',
            'provider_reference' => 'nullable|string',
            'status' => 'string',

        ];
    }
}
