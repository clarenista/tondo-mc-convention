<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    public $blade;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link = "#", $blade = 'email.reminder-1-week', $subject = 'Tailoring The Optimal Management of Ob-Gyn Conditions')
    {
        //
        $this->blade = $blade;
        $this->subject = $subject;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject($this->subject)
            ->view($this->blade, ['link' => $this->link]);
    }
}
