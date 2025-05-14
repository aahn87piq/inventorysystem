<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use OpenApi\Annotations as OA;

class InventoryController extends Controller
{
/**
 * @OA\Get(
 *     path="/api/inventory/global-view",
 *     tags={"Inventory"},
 *     summary="Get global inventory view",
 *     @OA\Parameter(name="country_id", in="query", required=false, @OA\Schema(type="integer")),
 *     @OA\Parameter(name="warehouse_id", in="query", required=false, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Inventory summary per product")
 * )
 */
    public function globalView(Request $request)
    {
        $query = Inventory::query()
            ->with(['product:id,name,sku', 'warehouse:id,name,country_id', 'warehouse.country:id,name']);

        if ($request->has('country_id')) {
            $query->whereHas('warehouse', function ($q) use ($request) {
                $q->where('country_id', $request->country_id);
            });
        }

        if ($request->has('warehouse_id')) {
            $query->where('warehouse_id', $request->warehouse_id);
        }

        $inventories = $query->get()->groupBy('product_id')->map(function ($group) {
            $first = $group->first();
            return [
                'product_id' => $first->product_id,
                'product_name' => $first->product->name,
                'sku' => $first->product->sku,
                'total_quantity' => $group->sum('quantity'),
            ];
        })->values();

        return response()->json($inventories);
    }
}
