<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku,' . $this->id,
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ];
    }
}
