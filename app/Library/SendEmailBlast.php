<?php

namespace App\Library;

use App\Mail\Email;
use App\Mail\EmailTemplate;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class SendEmailBlast
{

    public $email;
    public $link;

    public function __construct($mail, $link)
    {

        $this->email = $mail;
        $this->link = $link;
    }

    public function send()
    {

        Mail::to($this->email)->send(new EmailTemplate($this->link));
    }
}
