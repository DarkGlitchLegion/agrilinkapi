<?php

namespace App\Http\Controllers\Geography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Geography\StoreFarmCropRequest;
use App\Http\Requests\Geography\UpdateFarmCropRequest;
use App\Models\Geography\FarmCrop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class FarmCropController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => FarmCrop::query()->get()]);
    }

    public function store(StoreFarmCropRequest $request): JsonResponse
    {
        $farmCrop = FarmCrop::create($request->validated());

        return response()->json(['data' => $farmCrop], 201);
    }

    public function show(FarmCrop $farmCrop): JsonResponse
    {
        return response()->json(['data' => $farmCrop]);
    }

    public function update(UpdateFarmCropRequest $request, FarmCrop $farmCrop): JsonResponse
    {
        $farmCrop->update($request->validated());

        return response()->json(['data' => $farmCrop->refresh()]);
    }

    public function destroy(FarmCrop $farmCrop): Response
    {
        $farmCrop->delete();

        return response()->noContent();
    }
}
