<?php

namespace App\Http\Requests\MarketIntelligence;

use Illuminate\Foundation\Http\FormRequest;

class StorePriceObservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'commodity_id' => 'required|exists:commodities,id',
            'market_id' => 'required|exists:markets,id',
            'source_id' => 'required|exists:data_sources,id',
            'price_type' => 'required|string',
            'minimum_price' => 'required|numeric|min:0',
            'maximum_price' => 'required|numeric|min:0',
            'average_price' => 'required|numeric|min:0',
            'unit_id' => 'required|exists:units_of_measure,id',
            'observed_on' => 'required|date',
            'verification_status' => 'string',
            'submitted_by' => 'nullable|exists:users,id',

        ];
    }
}
