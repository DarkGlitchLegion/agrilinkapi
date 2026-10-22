<?php

namespace App\Http\Controllers\MarketIntelligence;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarketIntelligence\StorePriceAlertRequest;
use App\Http\Requests\MarketIntelligence\UpdatePriceAlertRequest;
use App\Models\MarketIntelligence\PriceAlert;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PriceAlertController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => PriceAlert::query()->get()]);
    }

    public function store(StorePriceAlertRequest $request): JsonResponse
    {
        $priceAlert = PriceAlert::create($request->validated());

        return response()->json(['data' => $priceAlert], 201);
    }

    public function show(PriceAlert $priceAlert): JsonResponse
    {
        return response()->json(['data' => $priceAlert]);
    }

    public function update(UpdatePriceAlertRequest $request, PriceAlert $priceAlert): JsonResponse
    {
        $priceAlert->update($request->validated());

        return response()->json(['data' => $priceAlert->refresh()]);
    }

    public function destroy(PriceAlert $priceAlert): Response
    {
        $priceAlert->delete();

        return response()->noContent();
    }
}
