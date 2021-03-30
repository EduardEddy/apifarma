<?php

namespace App\Observers\Password;

use App\Models\ResetPassword;
use Illuminate\Support\Str;

class PasswordResetObserver
{
    public function creating(ResetPassword $password)
    {
        try {
            $token = Str::random(40);
            $password->token=$token;
            $password->created_at = date('Y-m-d H:i:s');
        } catch (\Throwable $th) {
            \Log::alert('Error.- creating PasswordResetObserver: '.$th->getMessage().' | Line: '.$th->getLine());
        }
    }
}
