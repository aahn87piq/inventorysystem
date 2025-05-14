<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryTransactionRequest;
use App\Models\Inventory;
use App\Models\InventoryTransaction;
use OpenApi\Annotations as OA;

class InventoryTransactionController extends Controller
{
/**
 * @OA\Post(
 *     path="/api/inventory-transactions",
 *     tags={"Inventory"},
 *     summary="Record IN/OUT inventory transaction",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"product_id", "warehouse_id", "quantity", "transaction_type", "date", "created_by"},
 *             @OA\Property(property="product_id", type="integer"),
 *             @OA\Property(property="warehouse_id", type="integer"),
 *             @OA\Property(property="supplier_id", type="integer", nullable=true),
 *             @OA\Property(property="quantity", type="integer"),
 *             @OA\Property(property="transaction_type", type="string", enum={"IN", "OUT"}),
 *             @OA\Property(property="date", type="string", format="date"),
 *             @OA\Property(property="created_by", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Transaction recorded successfully")
 * )
 */
    public function store(InventoryTransactionRequest $request)
    {
        $data = $request->validated();

        $inventory = Inventory::firstOrCreate([
            'product_id' => $data['product_id'],
            'warehouse_id' => $data['warehouse_id'],
        ], ['quantity' => 0, 'minimum_quantity' => 0]);

        if ($data['transaction_type'] === 'OUT' && $inventory->quantity < $data['quantity']) {
            return response()->json(['message' => 'Insufficient stock'], 400);
        }

        $data['quantity'] = abs($data['quantity']);

        InventoryTransaction::create($data);

        $inventory->quantity += $data['transaction_type'] === 'IN' ? $data['quantity'] : -$data['quantity'];
        $inventory->save();

        return response()->json(['message' => 'Transaction recorded successfully']);
    }
}
