<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\User;
use App\Models\UserEvent;
use App\Models\UserEventCategory;
use Illuminate\Support\Facades\Http;
use \setasign\Fpdi\Fpdi;

class GuestController extends Controller
{

    public function boothTracker()
    {

        $booths = UserEventCategory::whereCategorizableType('App\Models\Booth')->with('categorizable')->whereHas('categorizable')->get();

        $boothTracks = UserEvent::whereIn('user_event_category_id', $booths->pluck('id'))->whereUserId(request()->user()->id)->whereLabel('visit')->where('created_at', '>', '2021-04-23 02:33:00')->get();

        $return = [];

        foreach ($booths as $booth) {
            if ($booth->name == "wedev-evaluation")  continue;
            $return[$booth->id] = [
                'name' => $booth->description,
                'visited' => boolval($boothTracks->where('user_event_category_id', $booth->id)->count()),
            ];
        }

        return $return;
    }

    public function hasEvaluation()
    {

        $user = request()->user();
        return [
            'sucess' => 'true',
            'done' => $user->answers,
        ];
    }

    public function generateCertificate()
    {
        // return null;
        $hasEvaluation = self::hasEvaluation();
        // if (count($hasEvaluation['done']) <= 0) {
        //     return response()->json(['status' => 'failed', 'message' => 'No evaluation found.']);
        // }
        define('FPDF_FONTPATH', app_path() . '/Http/Fonts/');
        $user =  \request()->user();
        $pdf = new FPDI('l', 'pt', 'Letter');

        $pdf->setSourceFile('documents/cert-of-appreciation.pdf');
        // Import the first page from the PDF and add to dynamic PDF
        $tpl = $pdf->importPage(1);
        // Bahnschrift
        $pdf->AddFont('Bahnschrift', '', 'bahnschrift.php');

        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetTextColor(54, 54, 54);
        // $pdf->SetLineWidth(0);

        $pdf->SetAutoPageBreak(false, 0);
        $pdf->SetFont('Bahnschrift', '', 27);

        $name = utf8_decode($user->name_on_cert);
        $pdf->SetXY(20, 295);
        $pdf->MultiCell(0, 30, $name, 0, 'C');
        return response($pdf->Output())
            ->header('Content-Type', 'application/pdf');
    }



    public function createCertificate(User $user)
    {
        // return null;
        // $hasEvaluation = self::hasEvaluation();
        // if (count($hasEvaluation['done']) <= 0) {
        //     return response()->json(['status' => 'failed', 'message' => 'No evaluation found.']);
        // }
        // define('FPDF_FONTPATH', app_path() . '/Http/Fonts/');
        // $user =  \request()->user();
        $pdf = new Fpdi('l', 'pt', 'Letter');

        $pdf->setSourceFile(storage_path('cpd-certification.pdf'));
        // Import the first page from the PDF and add to dynamic PDF
        $tpl = $pdf->importPage(1);
        // Bahnschrift
        // $pdf->AddFont('Bahnschrift', '', 'bahnschrift.php');

        $pdf->AddPage();
        $pdf->useTemplate($tpl);
        $pdf->SetTextColor(54, 54, 54);
        // $pdf->SetLineWidth(0);

        $pdf->SetAutoPageBreak(false, 0);
        $pdf->SetFont('Helvetica', '', 27);

        $name = utf8_decode($user->name_on_cert);
        $pdf->SetXY(20, 295);
        $pdf->MultiCell(0, 30, $name, 0, 'C');
        $pdf->Output(storage_path("certificates/{$user->id}-certificate-cpd.pdf"), "F");
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

        $registrants_api = "https://api.zoom.us/v2//webinars/{$webinar->unique_id}/registrants?page_size=300&page_number=5";
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $response = $client->get($registrants_api);
        $registrants = $response->json()['registrants'];
        $regs = collect($registrants);
        $all = $all->merge($regs);

        $registrants_api = "https://api.zoom.us/v2//webinars/{$webinar->unique_id}/registrants?page_size=300&page_number=6";
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $response = $client->get($registrants_api);
        $registrants = $response->json()['registrants'];
        $regs = collect($registrants);
        $all = $all->merge($regs);

        return $all->firstWhere('email', $email);
    }

    public function zoomJoinRH()
    {




        $user = request()->user();
        $webinar = Program::whereEnabled(1)->where('id', 6)->first();

        return 'https://myabbottmeetings.webex.com/myabbottmeetings/j.php?MTID=meb5878b4161919e4301b0dec72d96834';
        return 'https://us02web.zoom.us/j/' . $webinar->unique_id . '?pwd=' . $webinar->description;

        // if (!$webinar) {
        //     return 0;
        // }
        // $reg = $user->webinars()->where('webinar_id', $webinar->unique_id)->first();
        // if (!$reg) {
        //     $registered = $this->checkRegistrants($user->email_address, $webinar);
        //     if (!$registered) {
        //         // // DISABLE AUTO REGISTER
        //         // return "0";
        //         $registered = $this->registerToWebinar($webinar, $user);
        //         $registered['id'] = $registered['registrant_id'];
        //     }
        //     $reg = $user->webinars()->create([
        //         "registrant_id" => $registered['id'],
        //         "webinar_id" => $webinar->unique_id,
        //         "topic" => $webinar->title,
        //         "join_url" => $registered['join_url'],
        //         'registered' => true,
        //     ]);
        // }
        // return $reg->join_url;
    }

    public function zoomJoinBM()
    {
        $user = request()->user();
        $webinar = Program::whereEnabled(1)->where('id', 5)->first();
        if (!$webinar || !in_array($user->classification, ['Diplomate', 'Fellow', 'Life Member'])) {
            return 0;
        }
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

    public function zoomJoinMobile($webinar_id = "81037064653", $webinar_topic = "PSP70 - WEBINAR")
    {
        $user = request()->user();
        $webinar = Program::first();
        $reg = $user->webinars()->where('webinar_id', $webinar->unique_id)->first();
        if (!$reg) {
            // $registered = $this->checkRegistrants($user->email_address, $webinar);
            // if (!$registered) {
            // // DISABLE AUTO REGISTER
            // return "0";
            $registered = $this->registerToWebinar($webinar, $user);
            $registered['id'] = $registered['registrant_id'];
            // }
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

    private function registerToWebinar($webinar, $user)
    {
        $bearer = "Bearer ";
        $bearer .= $webinar->description;
        $client = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => $bearer]);
        $registrants_api = "https://api.zoom.us/v2/webinars/{$webinar->unique_id}/registrants";
        $post = [
            'email' => $user->email_address,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'org' => $user->hospital_affiliation ?? "N/A",
            'custom_questions' => [
                [
                    "title" => "MD Specialization",
                    "value" => $user->position ?? "N/A",
                ],
                [
                    "title" => "Consultant or Resident",
                    "value" => "Resident"
                ],
            ]
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
