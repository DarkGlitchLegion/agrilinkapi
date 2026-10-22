<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commerce\StoreMessageRequest;
use App\Http\Requests\Commerce\UpdateMessageRequest;
use App\Models\Commerce\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Message::query()->get()]);
    }

    public function store(StoreMessageRequest $request): JsonResponse
    {
        $message = Message::create($request->validated());

        return response()->json(['data' => $message], 201);
    }

    public function show(Message $message): JsonResponse
    {
        return response()->json(['data' => $message]);
    }

    public function update(UpdateMessageRequest $request, Message $message): JsonResponse
    {
        $message->update($request->validated());

        return response()->json(['data' => $message->refresh()]);
    }

    public function destroy(Message $message): Response
    {
        $message->delete();

        return response()->noContent();
    }
}
