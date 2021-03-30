<?php

namespace App\Observers\Invoices;

use Illuminate\Support\Str;
use App\Models\Invoice;

class InvoiceObserver
{
    public function creating(Invoice $invoice)
    {
        try {
            $invoice->id = (string) Str::uuid();
        } catch (\Throwable $th) {
            \Log::alert('Error.- creating InvoiceObserver: '.$th->getMessage().' | Line: '.$th->getLine());
        }
    }

    public function created(Invoice $invoice)
    {
        try {
            \Log::alert('eviar notificacion');
        } catch (\Throwable $th) {
            \Log::alert('Error.- created InvoiceObserver: '.$th->getMessage().' | Line: '.$th->getLine());
        }
    }
}
