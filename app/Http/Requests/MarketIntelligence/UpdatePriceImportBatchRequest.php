<?php

namespace App\Http\Requests\MarketIntelligence;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceImportBatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'source_id' => 'sometimes|required|exists:data_sources,id',
            'file_path' => 'sometimes|required|string',
            'imported_by' => 'sometimes|required|exists:users,id',
            'status' => 'sometimes|string',
        ];
    }
}
