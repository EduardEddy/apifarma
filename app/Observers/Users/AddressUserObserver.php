<?php

namespace App\Observers\Users;

use App\Models\AddressUser;
use DB;

class AddressUserObserver
{
    public function created(AddressUser $address)
    {
        $addresses = AddressUser::where('user_id',$address->user_id)
            ->where('id','<>',$address->id)
            ->get();
        foreach ($addresses as $key => $value) {
            $value->update(['select'=>false]);
        }
    }
}
