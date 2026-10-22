<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Identity\StorePermissionRequest;
use App\Http\Requests\Identity\UpdatePermissionRequest;
use App\Models\Identity\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Permission::query()->get()]);
    }

    public function store(StorePermissionRequest $request): JsonResponse
    {
        $permission = Permission::create($request->validated());

        return response()->json(['data' => $permission], 201);
    }

    public function show(Permission $permission): JsonResponse
    {
        return response()->json(['data' => $permission]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission): JsonResponse
    {
        $permission->update($request->validated());

        return response()->json(['data' => $permission->refresh()]);
    }

    public function destroy(Permission $permission): Response
    {
        $permission->delete();

        return response()->noContent();
    }
}
