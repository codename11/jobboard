<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class toHRFirst extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $job;
    public $jobCount;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$job,$jobCount)
    {
        $this->user = $user;
        $this->job = $job;
        $this->jobCount = $jobCount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.toHRFirst');
    }
}
