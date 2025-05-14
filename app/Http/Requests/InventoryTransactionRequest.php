<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryTransactionRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'transaction_type' => 'required|in:IN,OUT',
            'date' => 'required|date',
            'created_by' => 'required|integer'
        ];
    }
}
