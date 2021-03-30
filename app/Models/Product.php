<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','description','components','active','cant','price','image',
        'store_id','user_created_id','user_updated_id'
    ];

    protected $casts = [
        'id'=>'integer',
        'active'=>'boolean',
        'price'=>'float'
    ];

    /**
     * Get the store that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\Models\Store', 'store_id');
    }

    /**
     * Get the userCreated that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'user_created_id', 'id');
    }

    /**
     * Get the userUpdated that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'user_updated_id', 'id');
    }

    public static function getProductByArrayId($lstId)
    {
        $products = \DB::table('products')->whereIn('id',$lstId)
            ->orderBy('store_id','ASC')
            ->get();
        return $products;
    }

    public static function searchProduct($product, $country, $lat, $lng)
    {
        $products = \DB::select('call search_product(?,?,?,?)',[$lat,$lng,$country,$product]);
        return $products;
    }
}
