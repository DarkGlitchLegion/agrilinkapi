<?php

namespace App\Http\Controllers\MarketIntelligence;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarketIntelligence\StoreDataSourceRequest;
use App\Http\Requests\MarketIntelligence\UpdateDataSourceRequest;
use App\Models\MarketIntelligence\DataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DataSourceController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => DataSource::query()->get()]);
    }

    public function store(StoreDataSourceRequest $request): JsonResponse
    {
        $dataSource = DataSource::create($request->validated());

        return response()->json(['data' => $dataSource], 201);
    }

    public function show(DataSource $dataSource): JsonResponse
    {
        return response()->json(['data' => $dataSource]);
    }

    public function update(UpdateDataSourceRequest $request, DataSource $dataSource): JsonResponse
    {
        $dataSource->update($request->validated());

        return response()->json(['data' => $dataSource->refresh()]);
    }

    public function destroy(DataSource $dataSource): Response
    {
        $dataSource->delete();

        return response()->noContent();
    }
}
