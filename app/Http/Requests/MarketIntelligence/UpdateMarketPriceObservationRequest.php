<?php

namespace App\Http\Requests\MarketIntelligence;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarketPriceObservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'commodity_id' => 'sometimes|required|exists:commodities,id',
            'market_id' => 'sometimes|required|exists:markets,id',
            'source_id' => 'sometimes|required|exists:data_sources,id',
            'price_type' => 'sometimes|required|string',
            'minimum_price' => 'sometimes|required|numeric|min:0',
            'maximum_price' => 'sometimes|required|numeric|min:0',
            'average_price' => 'sometimes|required|numeric|min:0',
            'unit_id' => 'sometimes|required|exists:units_of_measure,id',
            'observed_on' => 'sometimes|required|date',
            'verification_status' => 'sometimes|string',
            'submitted_by' => 'nullable|exists:users,id',
        ];
    }
}
