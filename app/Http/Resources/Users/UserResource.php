<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'profile'=>$this->profile,

            'identification'=>$this->identification,
            //'country'=>$this->country,
            'type_identification'=>$this->type_identification,
            'verify_token'=>$this->verify_token,
            'store'=>$this->store,
            //'lng'=>$this->lng,
            //'lat'=>$this->lat,
            'addresses'=>$this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
