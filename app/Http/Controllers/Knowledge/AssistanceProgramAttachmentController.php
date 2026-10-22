<?php

namespace App\Http\Controllers\Knowledge;

use App\Http\Controllers\Controller;
use App\Http\Requests\Knowledge\StoreAssistanceProgramAttachmentRequest;
use App\Http\Requests\Knowledge\UpdateAssistanceProgramAttachmentRequest;
use App\Models\Knowledge\AssistanceProgramAttachment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AssistanceProgramAttachmentController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => AssistanceProgramAttachment::query()->get()]);
    }

    public function store(StoreAssistanceProgramAttachmentRequest $request): JsonResponse
    {
        $assistanceProgramAttachment = AssistanceProgramAttachment::create($request->validated());

        return response()->json(['data' => $assistanceProgramAttachment], 201);
    }

    public function show(AssistanceProgramAttachment $assistanceProgramAttachment): JsonResponse
    {
        return response()->json(['data' => $assistanceProgramAttachment]);
    }

    public function update(UpdateAssistanceProgramAttachmentRequest $request, AssistanceProgramAttachment $assistanceProgramAttachment): JsonResponse
    {
        $assistanceProgramAttachment->update($request->validated());

        return response()->json(['data' => $assistanceProgramAttachment->refresh()]);
    }

    public function destroy(AssistanceProgramAttachment $assistanceProgramAttachment): Response
    {
        $assistanceProgramAttachment->delete();

        return response()->noContent();
    }
}
