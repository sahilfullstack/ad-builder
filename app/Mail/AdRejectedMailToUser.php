<?php

namespace App\Mail;

use App\User;
use App\Models\Unit;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdRejectedMailToUser extends Mailable
{
    use SerializesModels;

    public $user;
    public $unit;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Unit $unit)
    {
        $this->user = $user;
        $this->unit = $unit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('SENDER_EMAIL'))
            ->subject("Ad Rejected")
            ->view("emails.add_rejected_to_user", ['user' => $this->user, 'unit' => $this->unit]);
    }
}
