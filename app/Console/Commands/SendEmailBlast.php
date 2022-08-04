<?php

namespace App\Console\Commands;

use App\Library\SendEmail;
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
        $users = User::where('id', '>', 47)->get();

        foreach ($users as $user) {
            echo $user->email_address . PHP_EOL;
            if (!$user->email_address) continue;
            (new SendEmailBlast($user->email_address))->send();
            // (new SendEmail($user->email_address))->send();
            sleep(1);
        }


        return 0;
    }
}
