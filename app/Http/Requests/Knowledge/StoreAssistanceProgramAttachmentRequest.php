<?php

namespace App\Http\Requests\Knowledge;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssistanceProgramAttachmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'assistance_program_id' => 'required|exists:assistance_programs,id',
            'storage_path' => 'required|string',
            'label' => 'nullable|string|max:255',

        ];
    }
}
