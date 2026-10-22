<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Identity\StoreVerificationDocumentRequest;
use App\Http\Requests\Identity\UpdateVerificationDocumentRequest;
use App\Models\Identity\VerificationDocument;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class VerificationDocumentController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => VerificationDocument::query()->get()]);
    }

    public function store(StoreVerificationDocumentRequest $request): JsonResponse
    {
        $verificationDocument = VerificationDocument::create($request->validated());

        return response()->json(['data' => $verificationDocument], 201);
    }

    public function show(VerificationDocument $verificationDocument): JsonResponse
    {
        return response()->json(['data' => $verificationDocument]);
    }

    public function update(UpdateVerificationDocumentRequest $request, VerificationDocument $verificationDocument): JsonResponse
    {
        $verificationDocument->update($request->validated());

        return response()->json(['data' => $verificationDocument->refresh()]);
    }

    public function destroy(VerificationDocument $verificationDocument): Response
    {
        $verificationDocument->delete();

        return response()->noContent();
    }
}
