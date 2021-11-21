<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Symfony\Component\Process\Process;

class DumpDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump database to /public';

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

        $dump_name = strtoupper(config('app.name')) . "_" . Carbon::now()->format("md_hiA") . ".sql";
        $cmd =  "mysqldump -u " . config('database.connections.mysql.username') .
                " -h " . config('database.connections.mysql.host') .
                " -p" . config('database.connections.mysql.password') .
                " " . config('database.connections.mysql.database') .
                " > " . \public_path($dump_name);
        echo $cmd . PHP_EOL;
        exec($cmd);
        echo config('app.url') . "/" . $dump_name . PHP_EOL;
    }
}
