<?php

namespace App\Http\Controllers\API\Invoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Invoices\InvoiceResource;
use App\Models\Invoice;
use App\Http\Requests\Invoice\UpdateStatusInvoiceRequest;

class InvoicesController extends Controller
{
    public function show( $invoice)
    {
        try {
            $lstInvoice = Invoice::with('store','user','invoiceProduct')->where('id',$invoice)->first();
            foreach ($lstInvoice->invoiceProduct as $key => $invoice) {
                $invoice->product;
            }
            return response()->json([
                'message'=>'success',
                'data'=>new InvoiceResource($lstInvoice)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- show InvoiceController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function updateDelivery( Invoice $invoice ,Request $request)
    {
        try {
            $change = $invoice->delivery =='domicilio'? 'local':'domicilio';
            $invoice->update([
                'delivery' => $change,
                'change_delivery' => 'solicitud'
            ]);
            return response()->json([
                'message'=>'success',
                'data'=>new InvoiceResource($invoice)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- updateDelivery InvoiceController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function updateStatus( Invoice $invoice ,UpdateStatusInvoiceRequest $request )
    {
        try {
            $invoice->update(['status'=>$request->status]);
            return response()->json([
                'message'=>'success',
                'data'=>new InvoiceResource($invoice)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- updateStatus InvoiceController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }
}
