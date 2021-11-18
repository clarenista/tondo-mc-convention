<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class ApacheDeploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apache:deploy {protocol=http} {skip=true}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apache Site Enabler';

    public function __construct()
    {
        parent::__construct();

        $this->env = config('app.env');
        $this->hst = parse_url(env('APP_URL'), PHP_URL_HOST);
        $this->dir = base_path();
        $this->pub = public_path();
        $this->log = storage_path() . "/logs";
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $vhost = $this->vhost();
        $vhostSSL = $this->vhost(true);
        $vhostWs = $this->vhostWs();

        if ($this->argument('protocol') == "http") {
            if ($this->argument('skip') == "true") {
                $this->deploy($vhost);
            } else {
                if ($this->confirm('Do you wish to create a VirtualHost:80 config?')) {
                    $this->deploy($vhost);
                }
            }
        }

        if ($this->argument('protocol') == "https") {
            if ($this->argument('skip') == "true") {
                $this->deploy($vhostSSL, true);
                $process = new Process(['sed', '-i', "s/#Redirect/Redirect/g", storage_path() . "/{$this->hst}.conf"]);
                $process->run(function ($type, $buffer) {
                    echo $buffer;
                });
            } else {
                if ($this->confirm('Do you wish to create a VirtualHost:443 config?')) {
                    $this->deploy($vhostSSL, true);
                    if ($this->confirm('Force redirect to HTTPS?')) {
                        $process = new Process(['sed', '-i', "s/#Redirect/Redirect/g", storage_path() . "/{$this->hst}.conf"]);
                        $process->run(function ($type, $buffer) {
                            echo $buffer;
                        });
                    }
                }
            }
        }

        if ($this->argument('protocol') == "ws") {
            if ($this->argument('skip') == "true") {
                $this->deploy($vhostWs, false, "socket.");
            } else {
                if ($this->confirm('Do you wish to create a Websocket ProxyPass on VirtualHost:443 config?')) {
                    $this->deploy($vhostWs, false, "socket.");
                }
            }
        }

        if ($this->argument('skip') == "true") {
            $process = new Process(['service', 'httpd', 'restart']);
            $process->run(function ($type, $buffer) {
                echo $buffer;
            });
        } else {
            if ($this->confirm('Do you wish to restart httpd?')) {
                $process = new Process(['service', 'httpd', 'restart']);
                $process->run(function ($type, $buffer) {
                    echo $buffer;
                });
            }
        }
    }

    private function deploy($vhost, $SSL = false, $WS = "")
    {
        echo $vhost . PHP_EOL;
        $suffix = $SSL ? '-SSL' : '';
        $vhost_conf = "{$WS}{$this->hst}{$suffix}.conf";
        $vhost_conf_storage = storage_path() . "/{$vhost_conf}";
        file_put_contents($vhost_conf_storage, $vhost);
        $httpd_conf_enabled = "/etc/httpd/sites-enabled/{$vhost_conf}";
        if ($this->argument('skip') == "true") {
            if (File::exists($httpd_conf_enabled)) {
                File::delete($httpd_conf_enabled);
            }
            echo $vhost_conf_storage . " " . $httpd_conf_enabled;
            $process = new Process(['ln', '-s', "{$vhost_conf_storage}", $httpd_conf_enabled]);
            $process->run(function ($type, $buffer) {
                echo $buffer;
            });
        } else {
            if ($this->confirm('Do you wish to enable vhost config')) {
                $enable = true;
                if (File::exists($httpd_conf_enabled)) {
                    if ($this->confirm('Do you wish to overwirte existing vhost config')) {
                        File::delete($httpd_conf_enabled);
                    } else {
                        $enable = false;
                    }
                }
                if ($enable) {
                    echo $vhost_conf_storage . " " . $httpd_conf_enabled;
                    $process = new Process(['ln', '-s', "{$vhost_conf_storage}", $httpd_conf_enabled]);
                    $process->run(function ($type, $buffer) {
                        echo $buffer;
                    });
                }
            }
        }
    }

    private function vhost($SSL = false)
    {
        $port = $SSL ? "443" : "80";
        $vhost[] = "<VirtualHost *:{$port}>";
        if ($SSL) {
            $vhost[] = "    Include /etc/letsencrypt/options-ssl-apache.conf";
            $vhost[] = "    SSLCertificateFile /etc/letsencrypt/live/{$this->hst}/cert.pem";
            $vhost[] = "    SSLCertificateKeyFile /etc/letsencrypt/live/{$this->hst}/privkey.pem";
            $vhost[] = "    SSLCertificateChainFile /etc/letsencrypt/live/{$this->hst}/chain.pem";
        }
        $vhost[] = "    ServerName {$this->hst}";
        $vhost[] = "    ServerAlias www.{$this->hst}";
        if (!$SSL) {
            $vhost[] = \str_replace("cms.", "", "    ServerAlias socket.{$this->hst}");
            $vhost[] = "    #Redirect permanent / https://{$this->hst}/";
        }
        $vhost[] = "    DocumentRoot {$this->pub}";
        $vhost[] = "    <Directory {$this->pub}>";
        $vhost[] = "        Options Indexes FollowSymLinks MultiViews";
        $vhost[] = "        AllowOverride All";
        $vhost[] = "        Order allow,deny";
        $vhost[] = "        allow from all";
        $vhost[] = "        Require all granted";
        $vhost[] = "    </Directory>";
        $vhost[] = "    LogLevel debug";
        $suffix = $SSL ? "-SSL" : "";
        $vhost[] = "    CustomLog {$this->log}/access.log{$suffix} combined";
        $vhost[] = "    ErrorLog {$this->log}/error.log{$suffix}";
        $vhost[] = "</VirtualHost>";
        return join(PHP_EOL, $vhost);
    }

    private function vhostWs()
    {
        $vhost[] = "<VirtualHost *:443>";
        $vhost[] = "    Include /etc/letsencrypt/options-ssl-apache.conf";
        $vhost[] = "    SSLCertificateFile /etc/letsencrypt/live/{$this->hst}/cert.pem";
        $vhost[] = "    SSLCertificateKeyFile /etc/letsencrypt/live/{$this->hst}/privkey.pem";
        $vhost[] = "    SSLCertificateChainFile /etc/letsencrypt/live/{$this->hst}/chain.pem";
        $vhost[] = \str_replace("cms.", "", "    ServerName socket.{$this->hst}");
        $vhost[] = "    <Proxy *>";
        $vhost[] = "        Require all granted";
        $vhost[] = "        Allow from all";
        $vhost[] = "    </Proxy>";
        $vhost[] = "    SSLEngine on";
        $vhost[] = "    SSLProxyEngine on";
        $vhost[] = "    SSLProxyVerify none";
        $vhost[] = "    SSLProxyCheckPeerCN off";
        $vhost[] = "    SSLProxyCheckPeerName off";
        $vhost[] = "    SSLProxyCheckPeerExpire off";
        $vhost[] = "    RewriteEngine on";
        $vhost[] = "    RewriteCond %{HTTP:Upgrade} =websocket [NC]";
        $vhost[] = "    RewriteRule .* wss://127.0.0.1:6003%{REQUEST_URI} [P]";
        $vhost[] = "    ProxyPass / wss://127.0.0.1:6003 disablereuse=On";
        $vhost[] = "    ProxyPassReverse / wss://127.0.0.1:6003 disablereuse=On";
        $vhost[] = "</VirtualHost>";
        return join(PHP_EOL, $vhost);
    }
}
