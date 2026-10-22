<?php

namespace App\Http\Controllers\Buyers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyers\StoreBusinessMemberRequest;
use App\Http\Requests\Buyers\UpdateBusinessMemberRequest;
use App\Models\Buyers\BusinessMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BusinessMemberController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => BusinessMember::query()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBusinessMemberRequest $request): JsonResponse
    {
        $businessMember = BusinessMember::create($request->validated());

        return response()->json(['data' => $businessMember], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BusinessMember $businessMember): JsonResponse
    {
        return response()->json(['data' => $businessMember]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBusinessMemberRequest $request, BusinessMember $businessMember): JsonResponse
    {
        $businessMember->update($request->validated());

        return response()->json(['data' => $businessMember->refresh()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusinessMember $businessMember): Response
    {
        $businessMember->delete();

        return response()->noContent();
    }
}
