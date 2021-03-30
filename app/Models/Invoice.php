<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    protected $fillable = [
        'id','store_id','user_id','subtotal','status','delivery',
        'comment_store','comment_user'
    ];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id'=>'string',
        'store_id'=>'integer',
        'user_id'=>'integer',
        'subtotal'=>'float',
    ];

    /**
     * Get the user that owns the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Get the store that owns the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\Models\Store', 'store_id', 'id');
    }
}
