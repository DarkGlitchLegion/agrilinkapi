<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'order_id' => 'required|exists:orders,id',
            'reviewer_user_id' => 'required|exists:users,id',
            'reviewed_user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'moderation_status' => 'string',

        ];
    }
}
