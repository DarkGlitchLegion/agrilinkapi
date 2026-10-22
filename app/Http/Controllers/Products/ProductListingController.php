<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductListingRequest;
use App\Http\Requests\Products\UpdateProductListingRequest;
use App\Models\Products\ProductListing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductListingController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => ProductListing::query()->get()]);
    }

    public function store(StoreProductListingRequest $request): JsonResponse
    {
        $productListing = ProductListing::create($request->validated());

        return response()->json(['data' => $productListing], 201);
    }

    public function show(ProductListing $productListing): JsonResponse
    {
        return response()->json(['data' => $productListing]);
    }

    public function update(UpdateProductListingRequest $request, ProductListing $productListing): JsonResponse
    {
        $productListing->update($request->validated());

        return response()->json(['data' => $productListing->refresh()]);
    }

    public function destroy(ProductListing $productListing): Response
    {
        $productListing->delete();

        return response()->noContent();
    }
}
