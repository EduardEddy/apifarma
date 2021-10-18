<?php

namespace App\Http\Resources\Invoices;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Invoices\InvoiceProductResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'store'=>$this->store,
            'user'=>$this->user,
            'subtotal'=>$this->subtotal,
            'status'=>$this->status,
            'delivery'=>$this->delivery,
            'comment_store'=>$this->comment_store,
            'comment_user'=>$this->comment_user,
            'invoice_product'=>$this->invoiceProduct,
            'address_user'=>$this->addressUser,
            'change_delivery'=>$this->change_delivery,
            'created_at'=>$this->created_at
        ];
    }
}
