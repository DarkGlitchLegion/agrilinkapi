<?php

namespace App\Http\Controllers\Geography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Geography\StoreFarmMemberRequest;
use App\Http\Requests\Geography\UpdateFarmMemberRequest;
use App\Models\Geography\FarmMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class FarmMemberController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => FarmMember::query()->get()]);
    }

    public function store(StoreFarmMemberRequest $request): JsonResponse
    {
        $farmMember = FarmMember::create($request->validated());

        return response()->json(['data' => $farmMember], 201);
    }

    public function show(FarmMember $farmMember): JsonResponse
    {
        return response()->json(['data' => $farmMember]);
    }

    public function update(UpdateFarmMemberRequest $request, FarmMember $farmMember): JsonResponse
    {
        $farmMember->update($request->validated());

        return response()->json(['data' => $farmMember->refresh()]);
    }

    public function destroy(FarmMember $farmMember): Response
    {
        $farmMember->delete();

        return response()->noContent();
    }
}
