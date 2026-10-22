<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commerce\StoreConversationParticipantRequest;
use App\Http\Requests\Commerce\UpdateConversationParticipantRequest;
use App\Models\Commerce\ConversationParticipant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ConversationParticipantController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => ConversationParticipant::query()->get()]);
    }

    public function store(StoreConversationParticipantRequest $request): JsonResponse
    {
        $conversationParticipant = ConversationParticipant::create($request->validated());

        return response()->json(['data' => $conversationParticipant], 201);
    }

    public function show(ConversationParticipant $conversationParticipant): JsonResponse
    {
        return response()->json(['data' => $conversationParticipant]);
    }

    public function update(UpdateConversationParticipantRequest $request, ConversationParticipant $conversationParticipant): JsonResponse
    {
        $conversationParticipant->update($request->validated());

        return response()->json(['data' => $conversationParticipant->refresh()]);
    }

    public function destroy(ConversationParticipant $conversationParticipant): Response
    {
        $conversationParticipant->delete();

        return response()->noContent();
    }
}
