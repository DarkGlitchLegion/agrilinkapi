<?php

namespace App\Http\Requests\MarketIntelligence;

use Illuminate\Foundation\Http\FormRequest;

class StorePriceImportBatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'source_id' => 'required|exists:data_sources,id',
            'file_path' => 'required|string',
            'imported_by' => 'required|exists:users,id',
            'status' => 'string',

        ];
    }
}
