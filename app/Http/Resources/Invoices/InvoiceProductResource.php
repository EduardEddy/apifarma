<?php

namespace App\Http\Resources\Invoices;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Invoices\InvoiceResource;
use App\Http\Resources\Products\ProductResource;

class InvoiceProductResource extends JsonResource
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
            'product'=>$this->product,
            'invoice'=>new InvoiceResource($this->invoice),
            'price'=>$this->price,
            'cant'=>$this->cant
        ];
    }
}
