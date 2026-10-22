<?php

namespace App\Http\Requests\MarketIntelligence;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDataSourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'source_type' => 'sometimes|required|string',
            'source_url' => 'nullable|url',
            'publisher' => 'nullable|string',
            'license_notes' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
