<?php

namespace App\Library;

use App\Mail\Email;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class SendEmail
{

    public $email;

    public function __construct($mail)
    {

        $this->email = $mail;
    }

    public function send()
    {

        Mail::to($this->email)->send(new Email());
    }
}
