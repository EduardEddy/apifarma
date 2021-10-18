<?php

namespace App\Classes\Invoice;

use App\Models\Invoice;
use App\Models\AddressUser;
use Auth;
use Illuminate\Support\Str;
use App\Events\NewInvoiceEvent;

class InvoiceClass
{
    public static function store($store, $price)
    {
        try {
            $address = AddressUser::where([
                'user_id'=>Auth::user()->id,
                'select'=>true
            ])->first();
            $invoice = Invoice::create([
                'store_id'=>$store,
                'user_id'=>Auth::user()->id,
                'address_user_id'=>$address->id,
                'subtotal'=>$price
            ]);
            event(new NewInvoiceEvent($store));

            return $invoice;
        } catch (\Throwable $th) {
            \Log::error('ERROR.- Store invoiceClass: '.$th->getMessage().' | Line: '.$th->getLine());
        }
    }

    public static function update(Invoice $invoice, $price)
    {
        try {
            $invoice->subtotal = $invoice->subtotal+$price;
            $invoice->save();
        } catch (\Throwable $th) {
            \Log::error('ERROR.- Update invoiceClass: '.$th->getMessage().' | Line: '.$th->getLine());
        }
    }
}
