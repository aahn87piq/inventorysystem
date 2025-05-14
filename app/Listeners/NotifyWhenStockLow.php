<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Events\InventoryLevelChecked;
use App\Notifications\LowStockNotification;
use App\Models\Inventory;
class NotifyWhenStockLow implements ShouldQueue
{
    public function handle(InventoryLevelChecked $event)
    {
        $inventory = $event->inventory;

        if ($inventory->quantity < $inventory->minimum_quantity) {
            Notification::route('mail', 'mail@domain.com')
                ->notify(new LowStockNotification($inventory));
        }
    }
}
