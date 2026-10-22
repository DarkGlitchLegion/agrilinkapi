<?php

namespace App\Http\Controllers\Buyers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyers\StoreBusinessProfileRequest;
use App\Http\Requests\Buyers\UpdateBusinessProfileRequest;
use App\Models\Buyers\BusinessProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BusinessProfileController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => BusinessProfile::query()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBusinessProfileRequest $request): JsonResponse
    {
        $businessProfile = BusinessProfile::create($request->validated());

        return response()->json(['data' => $businessProfile], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BusinessProfile $businessProfile): JsonResponse
    {
        return response()->json(['data' => $businessProfile]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBusinessProfileRequest $request, BusinessProfile $businessProfile): JsonResponse
    {
        $businessProfile->update($request->validated());

        return response()->json(['data' => $businessProfile->refresh()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusinessProfile $businessProfile): Response
    {
        $businessProfile->delete();

        return response()->noContent();
    }
}
