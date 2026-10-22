<?php

namespace App\Http\Controllers\Geography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Geography\StoreBarangayRequest;
use App\Http\Requests\Geography\UpdateBarangayRequest;
use App\Models\Geography\Barangay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BarangayController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Barangay::query()->get()]);
    }

    public function store(StoreBarangayRequest $request): JsonResponse
    {
        $barangay = Barangay::create($request->validated());

        return response()->json(['data' => $barangay], 201);
    }

    public function show(Barangay $barangay): JsonResponse
    {
        return response()->json(['data' => $barangay]);
    }

    public function update(UpdateBarangayRequest $request, Barangay $barangay): JsonResponse
    {
        $barangay->update($request->validated());

        return response()->json(['data' => $barangay->refresh()]);
    }

    public function destroy(Barangay $barangay): Response
    {
        $barangay->delete();

        return response()->noContent();
    }
}
