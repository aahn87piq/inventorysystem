<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Inventory;
use App\Mail\LowStockReportMail;

class GenerateLowStockReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $lowStockItems = Inventory::with(['product', 'warehouse.country', 'product'])
            ->whereColumn('quantity', '<', 'minimum_quantity')
            ->get();

        if ($lowStockItems->isEmpty()) {
            return;
        }

        $report = $lowStockItems->map(function ($item) {
            return [
                'Product Name' => $item->product->name,
                'SKU' => $item->product->sku,
                'Current Quantity' => $item->quantity,
                'Minimum Required' => $item->minimum_quantity,
                'Warehouse' => $item->warehouse->name,
                'Country' => $item->warehouse->country->name,
                'Supplier Contact' => optional($item->product->supplier)->contact_info,
            ];
        });

        Mail::to(env('LOW_STOCK_REPORT_EMAIL'))->send(new LowStockReportMail($report));
    }
}
