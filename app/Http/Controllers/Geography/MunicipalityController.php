<?php

namespace App\Http\Controllers\Geography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Geography\StoreMunicipalityRequest;
use App\Http\Requests\Geography\UpdateMunicipalityRequest;
use App\Models\Geography\Municipality;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MunicipalityController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Municipality::query()->get()]);
    }

    public function store(StoreMunicipalityRequest $request): JsonResponse
    {
        $municipality = Municipality::create($request->validated());

        return response()->json(['data' => $municipality], 201);
    }

    public function show(Municipality $municipality): JsonResponse
    {
        return response()->json(['data' => $municipality]);
    }

    public function update(UpdateMunicipalityRequest $request, Municipality $municipality): JsonResponse
    {
        $municipality->update($request->validated());

        return response()->json(['data' => $municipality->refresh()]);
    }

    public function destroy(Municipality $municipality): Response
    {
        $municipality->delete();

        return response()->noContent();
    }
}
