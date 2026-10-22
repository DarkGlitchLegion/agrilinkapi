<?php

namespace App\Http\Controllers\MarketIntelligence;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarketIntelligence\StorePriceImportBatchRequest;
use App\Http\Requests\MarketIntelligence\UpdatePriceImportBatchRequest;
use App\Models\MarketIntelligence\PriceImportBatch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PriceImportBatchController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => PriceImportBatch::query()->get()]);
    }

    public function store(StorePriceImportBatchRequest $request): JsonResponse
    {
        $priceImportBatch = PriceImportBatch::create($request->validated());

        return response()->json(['data' => $priceImportBatch], 201);
    }

    public function show(PriceImportBatch $priceImportBatch): JsonResponse
    {
        return response()->json(['data' => $priceImportBatch]);
    }

    public function update(UpdatePriceImportBatchRequest $request, PriceImportBatch $priceImportBatch): JsonResponse
    {
        $priceImportBatch->update($request->validated());

        return response()->json(['data' => $priceImportBatch->refresh()]);
    }

    public function destroy(PriceImportBatch $priceImportBatch): Response
    {
        $priceImportBatch->delete();

        return response()->noContent();
    }
}
