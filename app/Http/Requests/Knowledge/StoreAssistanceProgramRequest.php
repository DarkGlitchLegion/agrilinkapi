<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssistanceProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'provider_name' => 'required|string|max:255',
            'eligibility' => 'nullable|string',
            'application_instructions' => 'nullable|string',
            'official_url' => 'nullable|url',
            'opens_at' => 'nullable|date',
            'deadline_at' => 'nullable|date',
            'status' => 'string',
            'published_by' => 'required|exists:users,id',

        ];
    }
}
