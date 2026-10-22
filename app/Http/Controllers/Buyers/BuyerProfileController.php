<?php

namespace App\Http\Controllers\Buyers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyers\StoreBuyerProfileRequest;
use App\Http\Requests\Buyers\UpdateBuyerProfileRequest;
use App\Models\Buyers\BuyerProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BuyerProfileController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => BuyerProfile::query()->get()]);
    }

    public function store(StoreBuyerProfileRequest $request): JsonResponse
    {
        $buyerProfile = BuyerProfile::create($request->validated());

        return response()->json(['data' => $buyerProfile], 201);
    }

    public function show(BuyerProfile $buyerProfile): JsonResponse
    {
        return response()->json(['data' => $buyerProfile]);
    }

    public function update(UpdateBuyerProfileRequest $request, BuyerProfile $buyerProfile): JsonResponse
    {
        $buyerProfile->update($request->validated());

        return response()->json(['data' => $buyerProfile->refresh()]);
    }

    public function destroy(BuyerProfile $buyerProfile): Response
    {
        $buyerProfile->delete();

        return response()->noContent();
    }
}
