<?php

namespace App\Http\Resources\Stores;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'business_name'=>$this->business_name,
            'bussiness_id'=>$this->bussiness_id,
            'country'=>$this->country,
            'address'=>$this->address,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'is_open'=>$this->is_open,
            'status'=>$this->status,
            'user'=>$this->user
        ];
    }
}
