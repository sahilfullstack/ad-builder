<?php

namespace App\Mail;

use App\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountCreatedMailToUser extends Mailable
{
    use SerializesModels;

    public $user;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $password)
    {
        $this->user     = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('SENDER_EMAIL'))
            ->subject("Mesa Account Created")
            ->view("emails.account_created", ['user' => $this->user, 'password' => $this->password]);
    }
}
