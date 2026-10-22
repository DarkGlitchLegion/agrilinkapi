<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commerce\StoreReviewRequest;
use App\Http\Requests\Commerce\UpdateReviewRequest;
use App\Models\Commerce\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Review::query()->get()]);
    }

    public function store(StoreReviewRequest $request): JsonResponse
    {
        $review = Review::create($request->validated());

        return response()->json(['data' => $review], 201);
    }

    public function show(Review $review): JsonResponse
    {
        return response()->json(['data' => $review]);
    }

    public function update(UpdateReviewRequest $request, Review $review): JsonResponse
    {
        $review->update($request->validated());

        return response()->json(['data' => $review->refresh()]);
    }

    public function destroy(Review $review): Response
    {
        $review->delete();

        return response()->noContent();
    }
}
