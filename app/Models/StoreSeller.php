<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;
use App\Models\Store;

class StoreSeller extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','store_id','status','description'
    ];

    /**
     * Get all of the user for the StoreSeller
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    /**
     * Get all of the store for the StoreSeller
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function store()
    {
        return $this->hasMany(Store::class, 'id', 'store_id');
    }
}
