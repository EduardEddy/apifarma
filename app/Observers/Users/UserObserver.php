<?php

namespace App\Observers\Users;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user)
    {
        try {
            $random = Str::random(40);
            $user->verify_token = $random;
        } catch (\Throwable $th) {
            \Log::alert('Error.- creating UserObserver: '.$th->getMessage().' | Line: '.$th->getLine());
        }
    }
}
