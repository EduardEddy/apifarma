<?php

namespace App\Classes\Invoice;

use App\Models\Invoice;
use Auth;
use Illuminate\Support\Str;

class InvoiceClass
{
    public static function store($store)
    {
        try {
            $invoice = Invoice::create([
                'store_id'=>$store,
                'user_id'=>Auth::user()->id
            ]);
            return $invoice;
        } catch (\Throwable $th) {
            \Log::error('ERROR.- Store invoiceClass: '.$th->getMessage().' | Line: '.$th->getLine());
        }
    }
}
