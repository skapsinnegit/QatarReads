<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UnsubscribeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $program;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$program)
    { 
        $this->user = $user;
        $this->program = $program;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Unsubscription Confirmation')->view('emails.unsubscribeEmail');
    }
}