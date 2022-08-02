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

        $users = User::where('id','>',46)->get();

        foreach($users as $user){
            echo $user->email_address . PHP_EOL;
            // (new SendEmail($user->email_address))->send();
        }


        return 0;
    }
}
