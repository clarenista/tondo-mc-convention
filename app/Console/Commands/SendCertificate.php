<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\v1\GuestController;
use App\Mail\EmailCertificate;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PDO;

class SendCertificate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:certificate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // CREATE CERTIFICATES

        // define('FPDF_FONTPATH', app_path() . '/Http/Fonts/');
        // $us = User::where('id', '>', 46)->get();
        // $gc = new GuestController;
        // foreach ($us as $i => $u) {
        //     echo $i+1 . "/" . $us->count() . " - " . $u->email_address . PHP_EOL;
        //     $gc->createCertificate($u);
        // }
        // dd('here');

        // Mail::to('jayfructuoso@gmail.com')->send(new EmailCertificate(storage_path("certificates/377-certificate-cpd.pdf")));
        // // dd('here');
        $us = User::where('id', '>', 46)->whereHas('answers')->where('mobile_number', '<>', 2)->whereNotNull('email_address')->whereNotIn('id', [143, 150])->get();
        // // dd($us->count());
        foreach ($us as $i => $u) {
            if (!$u->email_address) continue;
            echo $i + 1 . "/" . $us->count() . " - " . $u->email_address . PHP_EOL;
            $u->update(['mobile_number' => 2]);
            Mail::to($u->email_address)->send(new EmailCertificate(storage_path("certificates/{$u->id}-certificate-cpd.pdf")));
            // Mail::to('jayfructuoso@gmail.com')->send(new EmailCertificate(storage_path("certificates/{$u->id}-certificate-cpd.pdf")));
        }

        // return 0;
    }
}
