<?php

namespace App\Classes\StoreSeller;

use App\Models\StoreSeller;

class StoreSellerClass
{
    public static function activeSeller($store, $seller)
    {
        StoreSeller::create([
            'user_id' => $seller->id,
            'store_id' => $store->id,
            'status'=>'active'
        ]);
    }
}
