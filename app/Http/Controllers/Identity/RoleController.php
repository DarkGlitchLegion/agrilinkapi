<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Identity\StoreRoleRequest;
use App\Http\Requests\Identity\UpdateRoleRequest;
use App\Models\Identity\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Role::query()->get()]);
    }

    public function store(StoreRoleRequest $request): JsonResponse
    {
        $role = Role::create($request->validated());

        return response()->json(['data' => $role], 201);
    }

    public function show(Role $role): JsonResponse
    {
        return response()->json(['data' => $role]);
    }

    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $role->update($request->validated());

        return response()->json(['data' => $role->refresh()]);
    }

    public function destroy(Role $role): Response
    {
        $role->delete();

        return response()->noContent();
    }
}
