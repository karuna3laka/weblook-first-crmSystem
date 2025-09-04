<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $paymentUrl;

    public function __construct($invoice, $paymentUrl)
    {
        $this->invoice = $invoice;
        $this->paymentUrl = $paymentUrl;
    }

    public function build()
    {
        return $this->subject('Your Invoice #' . $this->invoice->invoice_number)
            ->view('emails.invoice')
            ->with([
                'invoice' => $this->invoice,
                'paymentUrl' => $this->paymentUrl,
            ]);
    }
}
