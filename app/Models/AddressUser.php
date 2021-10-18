<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'country','city','address','lat','lng','user_id'
    ];
}
