<?php

namespace App\Http\Controllers\Geography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Geography\StoreFarmRequest;
use App\Http\Requests\Geography\UpdateFarmRequest;
use App\Models\Geography\Farm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class FarmController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Farm::query()->get()]);
    }

    public function store(StoreFarmRequest $request): JsonResponse
    {
        $farm = Farm::create($request->validated());

        return response()->json(['data' => $farm], 201);
    }

    public function show(Farm $farm): JsonResponse
    {
        return response()->json(['data' => $farm]);
    }

    public function update(UpdateFarmRequest $request, Farm $farm): JsonResponse
    {
        $farm->update($request->validated());

        return response()->json(['data' => $farm->refresh()]);
    }

    public function destroy(Farm $farm): Response
    {
        $farm->delete();

        return response()->noContent();
    }
}
