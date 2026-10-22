<?php

namespace App\Http\Requests\Identity;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVerificationDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|exists:users,id',
            'document_type' => 'sometimes|required|string|max:100',
            'file_path' => 'sometimes|required|string',
            'status' => 'sometimes|string',
            'reviewed_by' => 'nullable|exists:users,id',
        ];
    }
}
