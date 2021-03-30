<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ResetPassword extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'password_resets';
    protected $fillable = [
        'email', 'token', 'created_at'
    ];

    protected $casts = [
        'created_at'=>'datetime'
    ];
    public $timestamps = false;
}
