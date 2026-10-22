<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderStatusHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'order_id' => 'required|exists:orders,id',
            'previous_status' => 'required|string',
            'new_status' => 'required|string',
            'changed_by' => 'required|exists:users,id',
            'notes' => 'nullable|string',

        ];
    }
}
