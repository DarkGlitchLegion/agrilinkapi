<?php

namespace App\Http\Requests\Knowledge;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssistanceProgramAttachmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'assistance_program_id' => 'sometimes|required|exists:assistance_programs,id',
            'storage_path' => 'sometimes|required|string',
            'label' => 'nullable|string|max:255',
        ];
    }
}
