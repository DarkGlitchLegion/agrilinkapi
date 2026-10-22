<?php

namespace App\Http\Controllers\MarketIntelligence;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarketIntelligence\StoreMarketPriceObservationRequest;
use App\Http\Requests\MarketIntelligence\UpdateMarketPriceObservationRequest;
use App\Models\MarketIntelligence\MarketPriceObservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MarketPriceObservationController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => MarketPriceObservation::query()->get()]);
    }

    public function store(StoreMarketPriceObservationRequest $request): JsonResponse
    {
        $marketPriceObservation = MarketPriceObservation::create($request->validated());

        return response()->json(['data' => $marketPriceObservation], 201);
    }

    public function show(MarketPriceObservation $marketPriceObservation): JsonResponse
    {
        return response()->json(['data' => $marketPriceObservation]);
    }

    public function update(UpdateMarketPriceObservationRequest $request, MarketPriceObservation $marketPriceObservation): JsonResponse
    {
        $marketPriceObservation->update($request->validated());

        return response()->json(['data' => $marketPriceObservation->refresh()]);
    }

    public function destroy(MarketPriceObservation $marketPriceObservation): Response
    {
        $marketPriceObservation->delete();

        return response()->noContent();
    }
}
