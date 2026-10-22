<?php

namespace App\Http\Controllers\Knowledge;

use App\Http\Controllers\Controller;
use App\Http\Requests\Knowledge\StoreKnowledgeCategoryRequest;
use App\Http\Requests\Knowledge\UpdateKnowledgeCategoryRequest;
use App\Models\Knowledge\KnowledgeCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class KnowledgeCategoryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => KnowledgeCategory::query()->get()]);
    }

    public function store(StoreKnowledgeCategoryRequest $request): JsonResponse
    {
        $knowledgeCategory = KnowledgeCategory::create($request->validated());

        return response()->json(['data' => $knowledgeCategory], 201);
    }

    public function show(KnowledgeCategory $knowledgeCategory): JsonResponse
    {
        return response()->json(['data' => $knowledgeCategory]);
    }

    public function update(UpdateKnowledgeCategoryRequest $request, KnowledgeCategory $knowledgeCategory): JsonResponse
    {
        $knowledgeCategory->update($request->validated());

        return response()->json(['data' => $knowledgeCategory->refresh()]);
    }

    public function destroy(KnowledgeCategory $knowledgeCategory): Response
    {
        $knowledgeCategory->delete();

        return response()->noContent();
    }
}
