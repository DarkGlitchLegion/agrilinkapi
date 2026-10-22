<?php

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commerce\StoreInquiryRequest;
use App\Http\Requests\Commerce\UpdateInquiryRequest;
use App\Models\Commerce\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class InquiryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Inquiry::query()->get()]);
    }

    public function store(StoreInquiryRequest $request): JsonResponse
    {
        $inquiry = Inquiry::create($request->validated());

        return response()->json(['data' => $inquiry], 201);
    }

    public function show(Inquiry $inquiry): JsonResponse
    {
        return response()->json(['data' => $inquiry]);
    }

    public function update(UpdateInquiryRequest $request, Inquiry $inquiry): JsonResponse
    {
        $inquiry->update($request->validated());

        return response()->json(['data' => $inquiry->refresh()]);
    }

    public function destroy(Inquiry $inquiry): Response
    {
        $inquiry->delete();

        return response()->noContent();
    }
}
