<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    public function index()
    {
        return Supplier::all();
    }

    public function store(SupplierRequest $request)
    {
        return Supplier::create($request->validated());
    }

    public function show(Supplier $supplier)
    {
        return $supplier;
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return $supplier;
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->noContent();
    }
}
