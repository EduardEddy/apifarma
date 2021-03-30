<?php

namespace App\Observers\Stores;

use App\Models\Store;
use Auth;

class StoreObserver
{
    public function creating(Store $store)
    {
        try {
            $store->user_id=Auth::user()->id;
        } catch (\Throwable $th) {
            \Log::alert('Error.- creating StoreObserver: '.$th->getMessage().' | Line: '.$th->getLine());
        }
    }
}
