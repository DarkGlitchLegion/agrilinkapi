<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductImageRequest;
use App\Http\Requests\Products\UpdateProductImageRequest;
use App\Models\Products\ProductImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductImageController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => ProductImage::query()->get()]);
    }

    public function store(StoreProductImageRequest $request): JsonResponse
    {
        $productImage = ProductImage::create($request->validated());

        return response()->json(['data' => $productImage], 201);
    }

    public function show(ProductImage $productImage): JsonResponse
    {
        return response()->json(['data' => $productImage]);
    }

    public function update(UpdateProductImageRequest $request, ProductImage $productImage): JsonResponse
    {
        $productImage->update($request->validated());

        return response()->json(['data' => $productImage->refresh()]);
    }

    public function destroy(ProductImage $productImage): Response
    {
        $productImage->delete();

        return response()->noContent();
    }
}
