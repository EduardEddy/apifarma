<?php

namespace App\Imports\Products;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Product;
use Auth;
use App\Models\Store;

class ProductImport implements ToCollection
{
    protected $store;
    public function __construct($store)
    {
        $this->store = $store;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        try {
            foreach ($collection as $key => $product) {
                if($key == 0){
                    continue;
                }
                $image = null;
                if ($product[5] != null) {
                    $image = $this->validURLImage($product[5]);
                }
                Product::create([
                    'name'=>$product[0],
                    'description'=>$product[1],
                    'components'=>$product[2],
                    'cant'=>$product[3],
                    'price'=>floatval($product[4]),
                    'image'=>$image,
                    'store_id'=>$this->store
                ]);
            }
        } catch (\Throwable $th) {
            \Log::alert('Error.- ProductImport: '.$th->getMessage().' | Line: '.$th->getLine());
        }
    }

    public static function validURLImage($productImage)
    {
        $url = explode(".", $productImage);
        $count = count($url);
        $list = ['jpg','jpeg','png','svg'];
        if ( in_array($url[$count-1], $list) ) {
            return $productImage;
        }
        return null;
    }
}
