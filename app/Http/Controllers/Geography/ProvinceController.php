<?php

namespace App\Http\Controllers\Geography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Geography\StoreProvinceRequest;
use App\Http\Requests\Geography\UpdateProvinceRequest;
use App\Models\Geography\Province;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProvinceController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Province::query()->get()]);
    }

    public function store(StoreProvinceRequest $request): JsonResponse
    {
        $province = Province::create($request->validated());

        return response()->json(['data' => $province], 201);
    }

    public function show(Province $province): JsonResponse
    {
        return response()->json(['data' => $province]);
    }

    public function update(UpdateProvinceRequest $request, Province $province): JsonResponse
    {
        $province->update($request->validated());

        return response()->json(['data' => $province->refresh()]);
    }

    public function destroy(Province $province): Response
    {
        $province->delete();

        return response()->noContent();
    }
}
