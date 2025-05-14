<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LowStockReportMail extends Mailable
{
    public $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    public function build()
    {
        return $this->subject('Low Stock Report')
            ->markdown('emails.low_stock');
    }
}
