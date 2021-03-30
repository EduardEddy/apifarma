<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name'=>$this->name,
            'description'=>$this->description,
            'components'=>$this->components,
            'active'=>$this->active,
            'cant'=>$this->cant,
            'store'=>$this->store ?? '',
            'user_created'=>$this->userCreated??'',
            'user_updated'=>$this->userUpdated??''
        ];
    }
}
