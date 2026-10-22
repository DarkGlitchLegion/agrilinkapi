<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreListingReportRequest;
use App\Http\Requests\Products\UpdateListingReportRequest;
use App\Models\Products\ListingReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ListingReportController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => ListingReport::query()->get()]);
    }

    public function store(StoreListingReportRequest $request): JsonResponse
    {
        $listingReport = ListingReport::create($request->validated());

        return response()->json(['data' => $listingReport], 201);
    }

    public function show(ListingReport $listingReport): JsonResponse
    {
        return response()->json(['data' => $listingReport]);
    }

    public function update(UpdateListingReportRequest $request, ListingReport $listingReport): JsonResponse
    {
        $listingReport->update($request->validated());

        return response()->json(['data' => $listingReport->refresh()]);
    }

    public function destroy(ListingReport $listingReport): Response
    {
        $listingReport->delete();

        return response()->noContent();
    }
}
