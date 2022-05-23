<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\UserEvent;
use App\Models\UserEventCategory;
use Illuminate\Support\Facades\Http;

class GuestController extends Controller
{

    public function boothTracker()
    {

        $booths = UserEventCategory::whereCategorizableType('App\Models\Booth')->get();

        $boothTracks = UserEvent::whereIn('user_event_category_id', $booths->pluck('id'))->whereUserId(request()->user()->id)->whereLabel('visit')->where('created_at', '>', '2021-04-23 02:33:00')->get();

        $return = [];

        foreach ($booths as $booth) {
            $return[$booth->id] = [
                'name' => $booth->description,
                'visited' => boolval($boothTracks->where('user_event_category_id', $booth->id)->count()),
            ];
        }

        return $return;
    }


    private function checkRegistrants($email, $webinar)
    {
        $bearer = "Bearer ";
        $bearer .= $webinar->description;

        $all = collect([]);

        $registrants_api = "https://api.zoom.us/v2//webinars/{$webinar->unique_id}/registrants?page_size=300&page_number=1";
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $response = $client->get($registrants_api);
        $registrants = $response->json()['registrants'];
        $regs = collect($registrants);
        $all = $all->merge($regs);

        $registrants_api = "https://api.zoom.us/v2//webinars/{$webinar->unique_id}/registrants?page_size=300&page_number=2";
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $response = $client->get($registrants_api);
        $registrants = $response->json()['registrants'];
        $regs = collect($registrants);
        $all = $all->merge($regs);

        $registrants_api = "https://api.zoom.us/v2//webinars/{$webinar->unique_id}/registrants?page_size=300&page_number=3";
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $response = $client->get($registrants_api);
        $registrants = $response->json()['registrants'];
        $regs = collect($registrants);
        $all = $all->merge($regs);

        $registrants_api = "https://api.zoom.us/v2//webinars/{$webinar->unique_id}/registrants?page_size=300&page_number=4";
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $response = $client->get($registrants_api);
        $registrants = $response->json()['registrants'];
        $regs = collect($registrants);
        $all = $all->merge($regs);

        return $all->firstWhere('email', $email);
    }

    public function zoomJoinMobile($webinar_id = "81037064653", $webinar_topic = "PSP70 - WEBINAR")
    {

        // try {

            $user = request()->user();
            $webinar = Program::whereEnabled(1)->first();

            if ($webinar->unique_id == '81181139282') {
                $reg = $user->webinars()->where('webinar_id', $webinar->unique_id)->first();
                if (!$reg) {
                    $registered = $this->checkRegistrants($user->email_address, $webinar);
                    if (!$registered) {
                        // // DISABLE AUTO REGISTER
                        // return "0";
                        $registered = $this->registerToWebinar($webinar, $user);
                        $registered['id'] = $registered['registrant_id'];
                    }
                    $reg = $user->webinars()->create([
                        "registrant_id" => $registered['id'],
                        "webinar_id" => $webinar->unique_id,
                        "topic" => $webinar->title,
                        "join_url" => $registered['join_url'],
                        'registered' => true,
                    ]);
                }
                return $reg->join_url;
            }
            // if ($webinar->unique_id == '88443777764') {
            //     // $allowed = ['Diplomate', 'Fellow', 'Junior', 'Resident'];
            //     // if (!in_array($user->classification, $allowed)) {
            //     //     return "0";
            //     // }
            //     $reg = $user->fellowships()->where('webinar_id', $webinar->unique_id)->first();
            //     if (!$reg) {
            //         $registered = $this->checkRegistrants($user->email_address, $webinar);
            //         if (!$registered) {
            //             // // DISABLE AUTO REGISTER
            //             // return "0";
            //             $registered = $this->registerToWebinar($webinar, $user);
            //             $registered['id'] = $registered['registrant_id'];
            //         }
            //         $reg = $user->webinars()->create([
            //             "registrant_id" => $registered['id'],
            //             "webinar_id" => $webinar->unique_id,
            //             "topic" => $webinar->title,
            //             "join_url" => $registered['join_url'],
            //             'registered' => true,
            //         ]);
            //     }
            //     return $reg->join_url;
            // }
        // } catch (\Throwable $th) {

        //     return "https://us02web.zoom.us/w/81181139282?tk=oBShCrL2NOpFQ_ersJpWUNUfd8hP3mOQnEilJ1BcLCg.DQMAAAAUmb7l5RZGblBkVWtlalNlZU5UNTQtU2ZpZjVBAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA&uuid=WN_7Pk4i4aaQj2dJlO-xafWIg";
        // }
    }

    private function registerToWebinar($webinar, $user)
    {

        $bearer = "Bearer ";
        $bearer .= $webinar->description;
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $registrants_api = "https://api.zoom.us/v2//webinars/{$webinar->unique_id}/registrants";
        $post = [
            'email' => $user->email_address,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
        ];

        $response = $client->post($registrants_api, $post);
        \Log::info($response->json());
        return $response->json();
    }

    public function zoomJoin($meetingNumber = "78803086236")
    {

        $program = Program::first();
        $meetingNumber = $program->unique_id;
        $apiKey = '9srj55u0SxGqM9F2dUU1nA';
        $secret = 'GRa14V4N2ukM2Ci6yu8NSnzLmftWJnOf97BB';
        $passWord = $program->unique_code;
        $user = request()->user();
        $signature = $this->zoomSignature($apiKey, $secret, $meetingNumber);
        $userName = $user->first_name . " " . $user->last_name;
        $userEmail = strpos($user->email, '@') ? $user->email : $user->email . '@gmail.com';

        return compact('signature', 'meetingNumber', 'userName', 'apiKey', 'userEmail', 'passWord');
    }

    private function zoomSignature($api_key, $api_secret, $meeting_number, $role = 0)
    {

        date_default_timezone_set("UTC");
        $time = time() * 1000 - 30000;
        $data = base64_encode($api_key . $meeting_number . $time . $role);
        $hash = hash_hmac('sha256', $data, $api_secret, true);
        $_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);

        return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
    }
}
