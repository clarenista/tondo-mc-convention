<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserFellowship;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RegisterFellowshipGuest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:fellowship';

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

    public function handle()
    {

        $bearer = "Bearer ";
        $bearer .= "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6Ilc4am01TXdKUnEtS1Nrd2puTTZGY2ciLCJleHAiOjE2NDA4NzI4MDAsImlhdCI6MTYzODkxMDE0NX0.gnxE8aZozed2xbboz8230_eA8n8HYPHgcijVp-g46fE";
        $webinar_id = "88443777764";
        $webinar_topic = "PSP Midyear Convention: A Night of Virtual Fellowship";

        $registrants = $this->getRegistrants($webinar_id);

        $this->register_fellowship($webinar_id, $webinar_topic, $bearer, $registrants);

        return 0;
    }

    private function getRegistrants($webinar_id)
    {
        $bearer = "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6Ilc4am01TXdKUnEtS1Nrd2puTTZGY2ciLCJleHAiOjE2NDA4NzI4MDAsImlhdCI6MTYzODkxMDE0NX0.gnxE8aZozed2xbboz8230_eA8n8HYPHgcijVp-g46fE";

        $all = collect([]);

        $registrants_api = "https://api.zoom.us/v2//webinars/{$webinar_id}/registrants?page_size=300&page_number=1";
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $response = $client->get($registrants_api);
        // \Log::info($response);
        $registrants = $response->json()['registrants'];
        $regs = collect($registrants);
        $all = $all->merge($regs);

        $registrants_api = "https://api.zoom.us/v2//webinars/{$webinar_id}/registrants?page_size=300&page_number=2";
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $response = $client->get($registrants_api);
        // \Log::info($response);
        $registrants = $response->json()['registrants'];
        $regs = collect($registrants);
        $all = $all->merge($regs);

        $registrants_api = "https://api.zoom.us/v2//webinars/{$webinar_id}/registrants?page_size=300&page_number=3";
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $response = $client->get($registrants_api);
        // \Log::info($response);
        $registrants = $response->json()['registrants'];
        $regs = collect($registrants);
        $all = $all->merge($regs);

        $registrants_api = "https://api.zoom.us/v2//webinars/{$webinar_id}/registrants?page_size=300&page_number=4";
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $response = $client->get($registrants_api);
        // \Log::info($response);
        $registrants = $response->json()['registrants'];
        $regs = collect($registrants);
        $all = $all->merge($regs);

        echo $all->count() . PHP_EOL;
        return $all;
    }


    private function register_fellowship($webinar_id, $webinar_topic, $bearer, $registrants)
    {

        UserFellowship::truncate();
        $webinar_role = "Fellowship";
        $fellowship_api = "https://api.zoom.us/v2//webinars/{$webinar_id}/panelists";
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $response = $client->get($fellowship_api);
        $attendees = ['Diplomate', 'Fellow', 'Junior', 'Resident', 'Non-Member'];
        $users = User::whereIn('classification', $attendees)->where('id', '<>', 602)->get();
        // dd($users->count());
        foreach ($users as $user) {
            echo $user->id . PHP_EOL;
            try {
                $registered = $registrants->firstWhere('email', $user->email_address);
                if ($registered) {
                    \Log::info("REGISTERED : " . $user->id . " | "  . $user->email_address);
                    $user->fellowships()->create([
                        'registrant_id' => $registered['id'],
                        'webinar_id' => $webinar_id,
                        'topic' => $webinar_topic,
                        'role' => $webinar_role,
                        'join_url' => $registered['join_url'],
                    ]);
                } else {
                    \Log::info("NEW : " . $user->id . " | "  . $user->email_address);
                    $registrants_api = "https://api.zoom.us/v2//webinars/{$webinar_id}/registrants";
                    $post = [
                        'email' => $user->email_address,
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                    ];
                    $response = $client->post($registrants_api, $post);
                    $response = $response->json();
                    $registered = UserFellowship::whereRegistrantId($response['registrant_id'])->first();
                    $data = [
                        'registrant_id' => $response['registrant_id'],
                        'webinar_id' => $response['id'],
                        'topic' => $response['topic'],
                        'role' => $webinar_role,
                        'join_url' => $response['join_url'],
                    ];
                    $user->fellowships()->create($data);
                }
            } catch (\Throwable $th) {
                \Log::info("SKIPPED :: " . $user->id . " - " . $user->email_address);
            }
        }
        echo "DONE!";
    }
}
