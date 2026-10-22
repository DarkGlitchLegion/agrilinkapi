<?php

namespace App\Http\Requests\Commerce;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'sometimes|required|exists:orders,id',
            'reviewer_user_id' => 'sometimes|required|exists:users,id',
            'reviewed_user_id' => 'sometimes|required|exists:users,id',
            'rating' => 'sometimes|required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'moderation_status' => 'sometimes|string',
        ];
    }
}
