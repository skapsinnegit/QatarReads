<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $program;
    public $status;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$status,$program)
    {
        $this->user = $user;
        $this->status = $status;
        $this->program = $program;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Subscription Confirmation')->view('emails.subscribeEmail');
    }
}