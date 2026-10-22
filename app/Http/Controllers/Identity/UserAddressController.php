<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Identity\StoreUserAddressRequest;
use App\Http\Requests\Identity\UpdateUserAddressRequest;
use App\Models\Identity\UserAddress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserAddressController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => UserAddress::query()->get()]);
    }

    public function store(StoreUserAddressRequest $request): JsonResponse
    {
        $userAddress = UserAddress::create($request->validated());

        return response()->json(['data' => $userAddress], 201);
    }

    public function show(UserAddress $userAddress): JsonResponse
    {
        return response()->json(['data' => $userAddress]);
    }

    public function update(UpdateUserAddressRequest $request, UserAddress $userAddress): JsonResponse
    {
        $userAddress->update($request->validated());

        return response()->json(['data' => $userAddress->refresh()]);
    }

    public function destroy(UserAddress $userAddress): Response
    {
        $userAddress->delete();

        return response()->noContent();
    }
}
