<?php

namespace App\Http\Requests\Identity;

use Illuminate\Foundation\Http\FormRequest;

class StoreVerificationDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'user_id' => 'required|exists:users,id',
            'document_type' => 'required|string|max:100',
            'file_path' => 'required|string',
            'status' => 'string',
            'reviewed_by' => 'nullable|exists:users,id',

        ];
    }
}
