<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class ToMod extends Mailable
{
    use Queueable, SerializesModels;

    public $mod;
    public $job;
    public $jobCount;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mod,$job,$jobCount)
    {
        $this->mod = $mod;
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
        return $this->markdown('mail.toMod');
    }
}
