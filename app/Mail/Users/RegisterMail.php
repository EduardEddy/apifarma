<?php

namespace App\Mail\Users;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = env('FRONT')."/active-acount/".$this->user->verify_token;
        return $this->from($this->user->email)
            ->markdown('emails.users.register')
            ->with([
                'url'=>$url,
                'name'=>$this->user->name,
                'last_name'=>$this->user->last_name,
            ]);
    }
}
