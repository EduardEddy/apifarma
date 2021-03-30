<?php

namespace App\Observers\Stores;

use App\Models\StoreSeller;

class StoreSellerObserver
{
    public function created(StoreSeller $store_seller)
    {
        try {
            $list = StoreSeller::where([
                'store_id'=>$store_seller->store_id,
            ])
            ->where('user_id','<>',$store_seller->user_id)
            ->get();
            foreach ($list as $key => $value) {
                $value->status = 'inactive';
                $value->description = '';
                $value->save();
            }
        } catch (\Throwable $th) {
            \Log::alert('Error.- created StoreSellerObserver: '.$th->getMessage().' | Line: '.$th->getLine());
        }
    }
}
