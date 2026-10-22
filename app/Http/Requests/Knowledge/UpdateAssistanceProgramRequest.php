<?php

namespace App\Http\Requests\Knowledge;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssistanceProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'provider_name' => 'sometimes|required|string|max:255',
            'eligibility' => 'nullable|string',
            'application_instructions' => 'nullable|string',
            'official_url' => 'nullable|url',
            'opens_at' => 'nullable|date',
            'deadline_at' => 'nullable|date',
            'status' => 'sometimes|string',
            'published_by' => 'sometimes|required|exists:users,id',
        ];
    }
}
