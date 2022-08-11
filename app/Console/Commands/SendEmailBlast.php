<?php

namespace App\Console\Commands;

use App\Library\SendEmail;
use App\Library\SendEmailBlast as LibrarySendEmailBlast;
use App\Models\User;
use Illuminate\Console\Command;

class SendEmailBlast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:blast';

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

        // $users = User::where('id', '>', 47)->get();
        $users = User::where('id', '>', 46)->with('webinars')->whereHas('webinars')->get();

        foreach ($users as $i => $user) {
            echo $user->email_address . PHP_EOL;
            if (!$user->email_address) continue;
            $link = "#";
            $link = $user->webinars->first();
            $link = $link->join_url;
            // dd('jayfructuoso@gmail.com', $link);
            (new LibrarySendEmailBlast($user->email_address, $link))->send();
            // (new LibrarySendEmailBlast('jayfructuoso@gmail.com', $link))->send();
            // dd('HERE');
            // (new SendEmail($user->email_address))->send();
            if ($i % 5 == 0)
                sleep(1);
        }


        return 0;
    }
}
