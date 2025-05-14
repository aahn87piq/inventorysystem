<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\InventoryTransactionController;
use App\Http\Controllers\Api\InventoryTransferController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InventoryController;
Route::apiResource('countries', CountryController::class);
Route::apiResource('warehouses', WarehouseController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::post('inventory-transactions', [InventoryTransactionController::class, 'store']);
Route::post('inventory-transfer', [InventoryTransferController::class, 'transfer']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('auth/refresh', [AuthController::class, 'refresh']);
    Route::apiResource('countries', CountryController::class);
    Route::apiResource('warehouses', WarehouseController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('suppliers', SupplierController::class);
    Route::post('inventory-transactions', [InventoryTransactionController::class, 'store']);
    Route::post('inventory-transfer', [InventoryTransferController::class, 'transfer']);
});
Route::get('inventory/global-view', [InventoryController::class, 'globalView']);
