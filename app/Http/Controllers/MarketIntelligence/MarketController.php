<?php

namespace App\Http\Controllers\MarketIntelligence;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarketIntelligence\StoreMarketRequest;
use App\Http\Requests\MarketIntelligence\UpdateMarketRequest;
use App\Models\MarketIntelligence\Market;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MarketController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Market::query()->get()]);
    }

    public function store(StoreMarketRequest $request): JsonResponse
    {
        $market = Market::create($request->validated());

        return response()->json(['data' => $market], 201);
    }

    public function show(Market $market): JsonResponse
    {
        return response()->json(['data' => $market]);
    }

    public function update(UpdateMarketRequest $request, Market $market): JsonResponse
    {
        $market->update($request->validated());

        return response()->json(['data' => $market->refresh()]);
    }

    public function destroy(Market $market): Response
    {
        $market->delete();

        return response()->noContent();
    }
}
