<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductCategoryRequest;
use App\Http\Requests\Products\UpdateProductCategoryRequest;
use App\Models\Products\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductCategoryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => ProductCategory::query()->get()]);
    }

    public function store(StoreProductCategoryRequest $request): JsonResponse
    {
        $productCategory = ProductCategory::create($request->validated());

        return response()->json(['data' => $productCategory], 201);
    }

    public function show(ProductCategory $productCategory): JsonResponse
    {
        return response()->json(['data' => $productCategory]);
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory): JsonResponse
    {
        $productCategory->update($request->validated());

        return response()->json(['data' => $productCategory->refresh()]);
    }

    public function destroy(ProductCategory $productCategory): Response
    {
        $productCategory->delete();

        return response()->noContent();
    }
}
