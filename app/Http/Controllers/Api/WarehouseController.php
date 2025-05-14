<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Http\Requests\WarehouseRequest;

class WarehouseController extends Controller
{
    public function index()
    {
        return Warehouse::with('country')->get();
    }

    public function store(WarehouseRequest $request)
    {
        return Warehouse::create($request->validated());
    }

    public function show(Warehouse $warehouse)
    {
        return $warehouse->load('country');
    }

    public function update(WarehouseRequest $request, Warehouse $warehouse)
    {
        $warehouse->update($request->validated());
        return $warehouse;
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return response()->noContent();
    }
}
