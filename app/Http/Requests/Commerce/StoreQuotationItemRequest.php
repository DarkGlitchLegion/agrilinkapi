<?php

namespace App\Http\Requests$folder;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuotationItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'quotation_id' => 'required|exists:quotations,id',
            'description' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            'unit_id' => 'required|exists:units_of_measure,id',
            'unit_price' => 'required|numeric|min:0',
            'line_total' => 'required|numeric|min:0',

        ];
    }
}
