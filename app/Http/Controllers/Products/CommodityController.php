<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreCommodityRequest;
use App\Http\Requests\Products\UpdateCommodityRequest;
use App\Models\Products\Commodity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CommodityController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Commodity::query()->get()]);
    }

    public function store(StoreCommodityRequest $request): JsonResponse
    {
        $commodity = Commodity::create($request->validated());

        return response()->json(['data' => $commodity], 201);
    }

    public function show(Commodity $commodity): JsonResponse
    {
        return response()->json(['data' => $commodity]);
    }

    public function update(UpdateCommodityRequest $request, Commodity $commodity): JsonResponse
    {
        $commodity->update($request->validated());

        return response()->json(['data' => $commodity->refresh()]);
    }

    public function destroy(Commodity $commodity): Response
    {
        $commodity->delete();

        return response()->noContent();
    }
}
