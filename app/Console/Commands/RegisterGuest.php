<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class RegisterGuest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:guest';

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

        $first_name = "Jay";
        $last_name = "Fructuoso";
        $email = "jayfructuoso@email.com";
        $password = Hash::make('123');
        $name = $first_name . " " . $last_name;

        $guest = User::whereEmail($email);
        if (!$guest->exists()) {
            User::create(compact('name', 'first_name', 'last_name', 'email', 'password'));
        } else {
            $guest->update(compact('name', 'first_name', 'last_name', 'email', 'password'));
        }
    }
}
