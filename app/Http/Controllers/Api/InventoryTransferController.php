<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\InventoryTransferRequest;
use App\Models\Inventory;
use App\Models\InventoryTransaction;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class InventoryTransferController extends Controller
{
/**
 * @OA\Post(
 *     path="/api/inventory-transfer",
 *     tags={"Inventory"},
 *     summary="Transfer product between warehouses",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"product_id", "from_warehouse_id", "to_warehouse_id", "quantity", "date", "created_by"},
 *             @OA\Property(property="product_id", type="integer"),
 *             @OA\Property(property="from_warehouse_id", type="integer"),
 *             @OA\Property(property="to_warehouse_id", type="integer"),
 *             @OA\Property(property="quantity", type="integer"),
 *             @OA\Property(property="date", type="string", format="date"),
 *             @OA\Property(property="created_by", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Transfer successful")
 * )
 */
    public function transfer(InventoryTransferRequest $request)
    {
        $data = $request->validated();

        $fromInventory = Inventory::where([
            'product_id' => $data['product_id'],
            'warehouse_id' => $data['from_warehouse_id']
        ])->first();

        if (!$fromInventory || $fromInventory->quantity < $data['quantity']) {
            return response()->json(['message' => 'Insufficient stock in source warehouse'], 400);
        }

        DB::transaction(function () use ($data, $fromInventory) {
            $fromInventory->decrement('quantity', $data['quantity']);

            $toInventory = Inventory::firstOrCreate([
                'product_id' => $data['product_id'],
                'warehouse_id' => $data['to_warehouse_id']
            ], ['quantity' => 0, 'minimum_quantity' => 0]);

            $toInventory->increment('quantity', $data['quantity']);

            InventoryTransaction::create([
                'product_id' => $data['product_id'],
                'warehouse_id' => $data['from_warehouse_id'],
                'quantity' => $data['quantity'],
                'transaction_type' => 'OUT',
                'date' => $data['date'],
                'created_by' => $data['created_by'],
            ]);

            InventoryTransaction::create([
                'product_id' => $data['product_id'],
                'warehouse_id' => $data['to_warehouse_id'],
                'quantity' => $data['quantity'],
                'transaction_type' => 'IN',
                'date' => $data['date'],
                'created_by' => $data['created_by'],
            ]);
        });

        return response()->json(['message' => 'Transfer successful']);
    }
}
