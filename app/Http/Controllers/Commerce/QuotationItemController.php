<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commerce\StoreQuotationItemRequest;
use App\Http\Requests\Commerce\UpdateQuotationItemRequest;
use App\Models\Commerce\QuotationItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class QuotationItemController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => QuotationItem::query()->get()]);
    }

    public function store(StoreQuotationItemRequest $request): JsonResponse
    {
        $quotationItem = QuotationItem::create($request->validated());

        return response()->json(['data' => $quotationItem], 201);
    }

    public function show(QuotationItem $quotationItem): JsonResponse
    {
        return response()->json(['data' => $quotationItem]);
    }

    public function update(UpdateQuotationItemRequest $request, QuotationItem $quotationItem): JsonResponse
    {
        $quotationItem->update($request->validated());

        return response()->json(['data' => $quotationItem->refresh()]);
    }

    public function destroy(QuotationItem $quotationItem): Response
    {
        $quotationItem->delete();

        return response()->noContent();
    }
}
