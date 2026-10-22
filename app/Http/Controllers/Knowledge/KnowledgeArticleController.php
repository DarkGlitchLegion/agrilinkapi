<?php

namespace App\Http\Controllers\Knowledge;

use App\Http\Controllers\Controller;
use App\Http\Requests\Knowledge\StoreKnowledgeArticleRequest;
use App\Http\Requests\Knowledge\UpdateKnowledgeArticleRequest;
use App\Models\Knowledge\KnowledgeArticle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class KnowledgeArticleController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => KnowledgeArticle::query()->get()]);
    }

    public function store(StoreKnowledgeArticleRequest $request): JsonResponse
    {
        $knowledgeArticle = KnowledgeArticle::create($request->validated());

        return response()->json(['data' => $knowledgeArticle], 201);
    }

    public function show(KnowledgeArticle $knowledgeArticle): JsonResponse
    {
        return response()->json(['data' => $knowledgeArticle]);
    }

    public function update(UpdateKnowledgeArticleRequest $request, KnowledgeArticle $knowledgeArticle): JsonResponse
    {
        $knowledgeArticle->update($request->validated());

        return response()->json(['data' => $knowledgeArticle->refresh()]);
    }

    public function destroy(KnowledgeArticle $knowledgeArticle): Response
    {
        $knowledgeArticle->delete();

        return response()->noContent();
    }
}
