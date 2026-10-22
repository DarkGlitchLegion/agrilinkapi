<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreUnitOfMeasureRequest;
use App\Http\Requests\Products\UpdateUnitOfMeasureRequest;
use App\Models\Products\UnitOfMeasure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UnitOfMeasureController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => UnitOfMeasure::query()->get()]);
    }

    public function store(StoreUnitOfMeasureRequest $request): JsonResponse
    {
        $unitOfMeasure = UnitOfMeasure::create($request->validated());

        return response()->json(['data' => $unitOfMeasure], 201);
    }

    public function show(UnitOfMeasure $unitOfMeasure): JsonResponse
    {
        return response()->json(['data' => $unitOfMeasure]);
    }

    public function update(UpdateUnitOfMeasureRequest $request, UnitOfMeasure $unitOfMeasure): JsonResponse
    {
        $unitOfMeasure->update($request->validated());

        return response()->json(['data' => $unitOfMeasure->refresh()]);
    }

    public function destroy(UnitOfMeasure $unitOfMeasure): Response
    {
        $unitOfMeasure->delete();

        return response()->noContent();
    }
}
