<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\StoreUserNotificationPreferenceRequest;
use App\Http\Requests\Notifications\UpdateUserNotificationPreferenceRequest;
use App\Models\Notifications\UserNotificationPreference;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserNotificationPreferenceController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => UserNotificationPreference::query()->get()]);
    }

    public function store(StoreUserNotificationPreferenceRequest $request): JsonResponse
    {
        $userNotificationPreference = UserNotificationPreference::create($request->validated());

        return response()->json(['data' => $userNotificationPreference], 201);
    }

    public function show(UserNotificationPreference $userNotificationPreference): JsonResponse
    {
        return response()->json(['data' => $userNotificationPreference]);
    }

    public function update(UpdateUserNotificationPreferenceRequest $request, UserNotificationPreference $userNotificationPreference): JsonResponse
    {
        $userNotificationPreference->update($request->validated());

        return response()->json(['data' => $userNotificationPreference->refresh()]);
    }

    public function destroy(UserNotificationPreference $userNotificationPreference): Response
    {
        $userNotificationPreference->delete();

        return response()->noContent();
    }
}
