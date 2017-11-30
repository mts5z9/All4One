<?php

namespace all4one\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class rewardClaimed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $reward;
    public function __construct(Array $reward)
    {
        $this->reward = $reward;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->view('mail.claimed-reward')
                  ->with(['reward' , $this->reward]);
    }
}
