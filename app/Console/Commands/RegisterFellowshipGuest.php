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

        $this->register_fellowship($webinar_id, $webinar_topic, $bearer);

        return 0;
    }


    private function register_fellowship($webinar_id, $webinar_topic, $bearer)
    {

        $webinar_role = "Fellowship";
        $fellowship_api = "https://api.zoom.us/v2//webinars/{$webinar_id}/panelists";
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $response = $client->get($fellowship_api);
        // $attendees = ['Diplomate', 'Fellow', 'Junior', 'Resident'];
        $attendees = ['Non-Member'];
        $users = User::whereIn('classification', $attendees)->where('id', '>', 0)->get();
        // dd($users->count());
        foreach ($users as $user) {
            \Log::info([$user->id, $user->email_address]);
            // if ($user->email_address == "jayfructuoso@gmail.com") {
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
            // }
        }

        dd($users->toArray());
    }
}
