<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreListingPriceHistoryRequest;
use App\Http\Requests\Products\UpdateListingPriceHistoryRequest;
use App\Models\Products\ListingPriceHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ListingPriceHistoryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => ListingPriceHistory::query()->get()]);
    }

    public function store(StoreListingPriceHistoryRequest $request): JsonResponse
    {
        $listingPriceHistory = ListingPriceHistory::create($request->validated());

        return response()->json(['data' => $listingPriceHistory], 201);
    }

    public function show(ListingPriceHistory $listingPriceHistory): JsonResponse
    {
        return response()->json(['data' => $listingPriceHistory]);
    }

    public function update(UpdateListingPriceHistoryRequest $request, ListingPriceHistory $listingPriceHistory): JsonResponse
    {
        $listingPriceHistory->update($request->validated());

        return response()->json(['data' => $listingPriceHistory->refresh()]);
    }

    public function destroy(ListingPriceHistory $listingPriceHistory): Response
    {
        $listingPriceHistory->delete();

        return response()->noContent();
    }
}
