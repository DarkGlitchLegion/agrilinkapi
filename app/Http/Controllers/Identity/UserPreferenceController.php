<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Identity\StoreUserPreferenceRequest;
use App\Http\Requests\Identity\UpdateUserPreferenceRequest;
use App\Models\Identity\UserPreference;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserPreferenceController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => UserPreference::query()->get()]);
    }

    public function store(StoreUserPreferenceRequest $request): JsonResponse
    {
        $userPreference = UserPreference::create($request->validated());

        return response()->json(['data' => $userPreference], 201);
    }

    public function show(UserPreference $userPreference): JsonResponse
    {
        return response()->json(['data' => $userPreference]);
    }

    public function update(UpdateUserPreferenceRequest $request, UserPreference $userPreference): JsonResponse
    {
        $userPreference->update($request->validated());

        return response()->json(['data' => $userPreference->refresh()]);
    }

    public function destroy(UserPreference $userPreference): Response
    {
        $userPreference->delete();

        return response()->noContent();
    }
}
