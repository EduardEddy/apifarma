<?php

namespace App\Http\Controllers\API\Invoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\InvoiceProduct;
use App\Models\Product;
use App\Models\Invoice;
use App\Http\Resources\Invoices\InvoiceProductResource;
use App\Http\Resources\Invoices\InvoiceResource;
use App\Http\Requests\InvoicesProducts\StoreRequest;

use App\Classes\Invoice\InvoiceClass;
use Auth;

class InvoiceProductController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $invoices = Invoice::where('store_id',$user->store->id)->orderBy('created_at','DESC')->get();
            return response()->json([
                'message'=>'success',
                'data'=>InvoiceResource::collection($invoices)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- index InvoiceProductController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $products = Product::getProductByArrayId($request->products);
            $storeId=null;
            foreach ($products as $key => $product) {
                if($storeId != $product->store_id ){
                    $storeId = $product->store_id;
                    $invoice = InvoiceClass::store($product->store_id, $product->price);
                }else{
                    InvoiceClass::update($invoice, $product->price);
                }

                $invoiceProduct = InvoiceProduct::create([
                    'product_id'=>$product->id,
                    'invoice_id'=>$invoice->id,
                    'price'=>$product->price
                ]);
            }

            return response()->json([
                'message'=>'success',
                'data'=>null
            ], 201);
        } catch (\Throwable $th) {
            \Log::alert('Error.- store InvoiceProductController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function show(InvoiceProduct $invoice_product)
    {
        try {

            return response()->json([
                'message'=>'success',
                'data'=>new InvoiceProductResource($invoice_product)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- show InvoiceProductController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function update(InvoiceProduct $invoice_product, Request $request)
    {
        try {
            return response()->json([
                'message'=>'success',
                'data'=>new InvoiceProductResource($invoice_product)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- show InvoiceProductController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }
}
