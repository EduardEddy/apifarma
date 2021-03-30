<?php

namespace App\Observers\Products;

use App\Models\Product;
use Auth;

class ProductObserver
{
    public function creating(Product $product)
    {
        try {
            $product->user_created_id = Auth::user()->id;
        } catch (\Throwable $th) {
            \Log::alert('Error.- creating ProductObserver: '.$th->getMessage().' | Line: '.$th->getLine());
        }
    }

    public function updating(Product $product)
    {
        try {
            $product->user_updated_id = Auth::user()->id;
        } catch (\Throwable $th) {
            \Log::alert('Error.- updating ProductObserver: '.$th->getMessage().' | Line: '.$th->getLine());
        }
    }
}
