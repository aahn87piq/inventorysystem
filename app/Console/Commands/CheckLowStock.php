<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\GenerateLowStockReport;
class CheckLowStock extends Command
{
    protected $signature = 'inventory:check-low-stock';
    protected $description = 'Check for low stock and send report email';

    public function handle()
    {
        dispatch(new GenerateLowStockReport());
        $this->info('Low stock check job dispatched.');
    }
}
