<?php

namespace App\Mail\Password;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ResetPassword;
use App\Models\User;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $reset;
    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ResetPassword $reset, User $user)
    {
        $this->reset = $reset;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = env('FRONT')."/change-password/".$this->reset->token;
        \Log::alert($url);
        return $this->markdown('emails.password.reset')
        ->with([
            'url'=>$url,
            'name'=>$this->user->name,
            'last_name'=>$this->user->last_name,
        ]);
    }
}
