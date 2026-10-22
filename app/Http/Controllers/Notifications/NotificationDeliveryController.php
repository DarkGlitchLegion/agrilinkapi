<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\StoreNotificationDeliveryRequest;
use App\Http\Requests\Notifications\UpdateNotificationDeliveryRequest;
use App\Models\Notifications\NotificationDelivery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class NotificationDeliveryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => NotificationDelivery::query()->get()]);
    }

    public function store(StoreNotificationDeliveryRequest $request): JsonResponse
    {
        $notificationDelivery = NotificationDelivery::create($request->validated());

        return response()->json(['data' => $notificationDelivery], 201);
    }

    public function show(NotificationDelivery $notificationDelivery): JsonResponse
    {
        return response()->json(['data' => $notificationDelivery]);
    }

    public function update(UpdateNotificationDeliveryRequest $request, NotificationDelivery $notificationDelivery): JsonResponse
    {
        $notificationDelivery->update($request->validated());

        return response()->json(['data' => $notificationDelivery->refresh()]);
    }

    public function destroy(NotificationDelivery $notificationDelivery): Response
    {
        $notificationDelivery->delete();

        return response()->noContent();
    }
}
