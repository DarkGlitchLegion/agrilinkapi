<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commerce\StoreOrderItemRequest;
use App\Http\Requests\Commerce\UpdateOrderItemRequest;
use App\Models\Commerce\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OrderItemController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => OrderItem::query()->get()]);
    }

    public function store(StoreOrderItemRequest $request): JsonResponse
    {
        $orderItem = OrderItem::create($request->validated());

        return response()->json(['data' => $orderItem], 201);
    }

    public function show(OrderItem $orderItem): JsonResponse
    {
        return response()->json(['data' => $orderItem]);
    }

    public function update(UpdateOrderItemRequest $request, OrderItem $orderItem): JsonResponse
    {
        $orderItem->update($request->validated());

        return response()->json(['data' => $orderItem->refresh()]);
    }

    public function destroy(OrderItem $orderItem): Response
    {
        $orderItem->delete();

        return response()->noContent();
    }
}
