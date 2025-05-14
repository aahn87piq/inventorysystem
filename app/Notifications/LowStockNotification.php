<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Inventory;
class LowStockNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $inventory;

    public function __construct(Inventory $inventory)
    {
        $this->inventory = $inventory;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Low Stock Alert')
            ->line("Product: {$this->inventory->product->name}")
            ->line("Warehouse: {$this->inventory->warehouse->name}")
            ->line("Quantity: {$this->inventory->quantity}")
            ->line("Minimum Required: {$this->inventory->minimum_quantity}");
    }
}
