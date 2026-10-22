<?php

namespace App\Http\Controllers\Knowledge;

use App\Http\Controllers\Controller;
use App\Http\Requests\Knowledge\StoreAssistanceProgramRequest;
use App\Http\Requests\Knowledge\UpdateAssistanceProgramRequest;
use App\Models\Knowledge\AssistanceProgram;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AssistanceProgramController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => AssistanceProgram::query()->get()]);
    }

    public function store(StoreAssistanceProgramRequest $request): JsonResponse
    {
        $assistanceProgram = AssistanceProgram::create($request->validated());

        return response()->json(['data' => $assistanceProgram], 201);
    }

    public function show(AssistanceProgram $assistanceProgram): JsonResponse
    {
        return response()->json(['data' => $assistanceProgram]);
    }

    public function update(UpdateAssistanceProgramRequest $request, AssistanceProgram $assistanceProgram): JsonResponse
    {
        $assistanceProgram->update($request->validated());

        return response()->json(['data' => $assistanceProgram->refresh()]);
    }

    public function destroy(AssistanceProgram $assistanceProgram): Response
    {
        $assistanceProgram->delete();

        return response()->noContent();
    }
}
