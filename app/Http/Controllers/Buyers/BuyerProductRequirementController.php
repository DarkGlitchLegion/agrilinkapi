<?php

namespace App\Http\Controllers\Buyers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyers\StoreBuyerProductRequirementRequest;
use App\Http\Requests\Buyers\UpdateBuyerProductRequirementRequest;
use App\Models\Buyers\BuyerProductRequirement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BuyerProductRequirementController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => BuyerProductRequirement::query()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuyerProductRequirementRequest $request): JsonResponse
    {
        $buyerProductRequirement = BuyerProductRequirement::create($request->validated());

        return response()->json(['data' => $buyerProductRequirement], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BuyerProductRequirement $buyerProductRequirement): JsonResponse
    {
        return response()->json(['data' => $buyerProductRequirement]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateBuyerProductRequirementRequest $request,
        BuyerProductRequirement $buyerProductRequirement,
    ): JsonResponse {
        $buyerProductRequirement->update($request->validated());

        return response()->json(['data' => $buyerProductRequirement->refresh()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BuyerProductRequirement $buyerProductRequirement): Response
    {
        $buyerProductRequirement->delete();

        return response()->noContent();
    }
}
