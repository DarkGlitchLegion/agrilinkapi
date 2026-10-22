<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commerce\StoreOrderStatusHistoryRequest;
use App\Http\Requests\Commerce\UpdateOrderStatusHistoryRequest;
use App\Models\Commerce\OrderStatusHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OrderStatusHistoryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => OrderStatusHistory::query()->get()]);
    }

    public function store(StoreOrderStatusHistoryRequest $request): JsonResponse
    {
        $orderStatusHistory = OrderStatusHistory::create($request->validated());

        return response()->json(['data' => $orderStatusHistory], 201);
    }

    public function show(OrderStatusHistory $orderStatusHistory): JsonResponse
    {
        return response()->json(['data' => $orderStatusHistory]);
    }

    public function update(UpdateOrderStatusHistoryRequest $request, OrderStatusHistory $orderStatusHistory): JsonResponse
    {
        $orderStatusHistory->update($request->validated());

        return response()->json(['data' => $orderStatusHistory->refresh()]);
    }

    public function destroy(OrderStatusHistory $orderStatusHistory): Response
    {
        $orderStatusHistory->delete();

        return response()->noContent();
    }
}
