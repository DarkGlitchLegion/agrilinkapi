<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreSavedListingRequest;
use App\Http\Requests\Products\UpdateSavedListingRequest;
use App\Models\Products\SavedListing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SavedListingController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => SavedListing::query()->get()]);
    }

    public function store(StoreSavedListingRequest $request): JsonResponse
    {
        $savedListing = SavedListing::create($request->validated());

        return response()->json(['data' => $savedListing], 201);
    }

    public function show(SavedListing $savedListing): JsonResponse
    {
        return response()->json(['data' => $savedListing]);
    }

    public function update(UpdateSavedListingRequest $request, SavedListing $savedListing): JsonResponse
    {
        $savedListing->update($request->validated());

        return response()->json(['data' => $savedListing->refresh()]);
    }

    public function destroy(SavedListing $savedListing): Response
    {
        $savedListing->delete();

        return response()->noContent();
    }
}
