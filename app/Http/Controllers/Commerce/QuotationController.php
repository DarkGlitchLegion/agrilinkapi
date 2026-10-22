<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commerce\StoreQuotationRequest;
use App\Http\Requests\Commerce\UpdateQuotationRequest;
use App\Models\Commerce\Quotation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class QuotationController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Quotation::query()->get()]);
    }

    public function store(StoreQuotationRequest $request): JsonResponse
    {
        $quotation = Quotation::create($request->validated());

        return response()->json(['data' => $quotation], 201);
    }

    public function show(Quotation $quotation): JsonResponse
    {
        return response()->json(['data' => $quotation]);
    }

    public function update(UpdateQuotationRequest $request, Quotation $quotation): JsonResponse
    {
        $quotation->update($request->validated());

        return response()->json(['data' => $quotation->refresh()]);
    }

    public function destroy(Quotation $quotation): Response
    {
        $quotation->delete();

        return response()->noContent();
    }
}
