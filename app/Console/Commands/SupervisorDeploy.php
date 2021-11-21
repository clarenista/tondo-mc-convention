<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class SupervisorDeploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'supervisor:deploy {app=all}';

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

        $this->env = config('app.env');
        $this->app = config('app.name');
        $this->dir = base_path();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        if (in_array($this->argument('app'), ["ws", "all"])) {
            $port = config('broadcasting.connections.pusher.options.port');
            $workers[] = $this->worker('websocket', "websockets:serve --port={$port}");
        }

        if (in_array($this->argument('app'), ["cms", "all"])) {

            $workers[] = $this->worker('broadcasting-worker', 'queue:work redis --queue=broadcast-' . $this->env);

            $workers[] = $this->worker('sms-worker', 'queue:work redis --queue=sms-' . $this->env);

            $workers[] = $this->worker('email-worker', 'queue:work redis --queue=email-' . $this->env);

            $workers[] = $this->worker('emoji-worker', 'queue:work redis --queue=emoji-' . $this->env);

            for ($i = 1; $i <= 10; $i++) {
                $workers[] = $this->worker("analytics-worker-{$i}", "queue:work redis --queue=analytics-" . $this->env);
            }

            $workers[] = $this->cacheOnlineUser();
            $workers[] = $this->cacheLeaderboardTop();
            $workers[] = $this->cacheGameboardTop();

        }

        echo join(PHP_EOL, $workers);

        if ($this->confirm('Do you wish to deploy?')) {
            $this->deploy($workers);
        }
    }

    private function deploy($workers)
    {

        $file_name = "{$this->app}-{$this->env}.ini";
        file_put_contents(storage_path("/{$file_name}"), join(PHP_EOL, $workers));
        $file_ini = "/etc/supervisord.d/{$file_name}";
        if (File::exists($file_ini)) {
            if ($this->confirm('Do you wish to delete existing config')) {
                File::delete($file_ini);
            }
        }

        $process = new Process(['ln', '-s', "{$this->dir}/storage/{$file_name}", $file_ini]);
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });

        $process = new Process(['supervisorctl', 'reread']);
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });

        $process = new Process(['supervisorctl', 'update']);
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });

        if ($this->confirm('Do you wish to restart all?')) {
            $process = new Process(['supervisorctl', 'restart all']);
            $process->run(function ($type, $buffer) {
                echo $buffer;
            });
        }
    }

    private function worker($name, $command, $log = false, $cli = false)
    {

        $log = $log ? $log : $name;

        $worker[] = "[program:{$this->app}-{$this->env}-{$name}]";

        if (!$cli) {
            $worker[] = "command=php {$this->dir}/artisan {$command}";
        }

        if ($cli) {
            $worker[] = "command={$cli} {$command}";
        }

        $worker[] = "directory={$this->dir}/";
        $worker[] = "stdout_logfile={$this->dir}/storage/logs/{$log}.log";
        $worker[] = "redirect_stderr=true";
        $worker[] = "autostart=true";
        $worker[] = "autorestart=true";
        $worker[] = "user=root";
        $worker[] = "";

        return join(PHP_EOL, $worker);
    }

    private function cacheOnlineUser()
    {

        $log = storage_path("logs/online-user-worker.log");
        $sh[] = "#!/bin/sh";
        $sh[] = "while true;";
        $sh[] = "    do php {$this->dir}/artisan cache:networking-lounge >> {$log};";
        $sh[] = "sleep 5; done";

        file_put_contents(storage_path("{$this->app}/cacheOnlineUser.sh"), join(PHP_EOL, $sh));

        return $this->worker('online-user', storage_path("{$this->app}/cacheOnlineUser.sh"), 'online-user-worker', 'sh');
    }

    private function cacheLeaderboardTop()
    {

        $log = storage_path("logs/leaderboard-top-worker.log");
        $sh[] = "#!/bin/sh";
        $sh[] = "while true;";
        $sh[] = "    do php {$this->dir}/artisan cache:leaderboard-top >> {$log};";
        $sh[] = "sleep 20; done";

        file_put_contents(storage_path("{$this->app}/cacheLeaderboardTop.sh"), join(PHP_EOL, $sh));

        return $this->worker('leaderboard-top', storage_path("{$this->app}/cacheLeaderboardTop.sh"), 'leaderboard-top-worker', 'sh');
    }

    private function cacheGameboardTop()
    {

        $log = storage_path("logs/gameboard-top-worker.log");
        $sh[] = "#!/bin/sh";
        $sh[] = "while true;";
        $sh[] = "    do php {$this->dir}/artisan cache:gameboard-top >> {$log};";
        $sh[] = "sleep 20; done";

        file_put_contents(storage_path("{$this->app}/cacheGameboardTop.sh"), join(PHP_EOL, $sh));

        return $this->worker('gameboard-top', storage_path("{$this->app}/cacheGameboardTop.sh"), 'gameboard-top-worker', 'sh');
    }
}
