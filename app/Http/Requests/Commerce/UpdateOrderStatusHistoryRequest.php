<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'sometimes|required|exists:orders,id',
            'previous_status' => 'sometimes|required|string',
            'new_status' => 'sometimes|required|string',
            'changed_by' => 'sometimes|required|exists:users,id',
            'notes' => 'nullable|string',
        ];
    }
}
