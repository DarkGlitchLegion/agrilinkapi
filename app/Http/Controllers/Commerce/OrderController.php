<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commerce\StoreOrderRequest;
use App\Http\Requests\Commerce\UpdateOrderRequest;
use App\Models\Commerce\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Order::query()->get()]);
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        $order = Order::create($request->validated());

        return response()->json(['data' => $order], 201);
    }

    public function show(Order $order): JsonResponse
    {
        return response()->json(['data' => $order]);
    }

    public function update(UpdateOrderRequest $request, Order $order): JsonResponse
    {
        $order->update($request->validated());

        return response()->json(['data' => $order->refresh()]);
    }

    public function destroy(Order $order): Response
    {
        $order->delete();

        return response()->noContent();
    }
}
