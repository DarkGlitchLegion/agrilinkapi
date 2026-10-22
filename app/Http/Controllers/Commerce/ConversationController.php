<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commerce\StoreConversationRequest;
use App\Http\Requests\Commerce\UpdateConversationRequest;
use App\Models\Commerce\Conversation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ConversationController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Conversation::query()->get()]);
    }

    public function store(StoreConversationRequest $request): JsonResponse
    {
        $conversation = Conversation::create($request->validated());

        return response()->json(['data' => $conversation], 201);
    }

    public function show(Conversation $conversation): JsonResponse
    {
        return response()->json(['data' => $conversation]);
    }

    public function update(UpdateConversationRequest $request, Conversation $conversation): JsonResponse
    {
        $conversation->update($request->validated());

        return response()->json(['data' => $conversation->refresh()]);
    }

    public function destroy(Conversation $conversation): Response
    {
        $conversation->delete();

        return response()->noContent();
    }
}
