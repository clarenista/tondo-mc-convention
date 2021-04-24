<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        return view("cms.home");
    }

    public function registration()
    {
        return view("home.registration");
    }

    public function gallery()
    {
        return view("home.gallery");
    }

    public function login(Request $request)
    {

        $guzzle = new \GuzzleHttp\Client;
        $token = $guzzle->post(config('app.domain') . '/oauth/token', [
            'form_params' => [
                'grant_type' => config('app.passport.grant_type'),
                'client_id' => config('app.passport.client_id'),
                'client_secret' => config('app.passport.client_secret'),
                'scope' => '*',
            ],
        ]);
        $response = $guzzle->post(config('app.domain') . '/api/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . json_decode((string) $token->getBody(), true)['access_token'],
            ],
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
            ],
        ]);
        $result = json_decode((string) $response->getBody(), true);
        if ($result) {
            if ($result['status'] == "failed") {
                $message = isset($result['message']) ? $result['message'] : "Payment not verified.";
                Log::info("USER ERROR: " . $message . " : " . $request->email);
                return response()->json([
                    'status' => 'failed',
                    'message' => $message,
                ]);
            }
            $user = User::firstOrCreate([
                'registrant_id' => $result['user']['id'],
            ], [
                'registrant_id' => $result['user']['id'],
                'api_token' => hash('sha256', Str::random(80)),
                'name' => $result['user']['first_name'] . " " . $result['user']['last_name'],
                'first_name' => $result['user']['first_name'],
                'last_name' => $result['user']['last_name'],
                'mobile_number' => $result['user']['contact'],
                'email' => $result['user']['username'],
                'email_address' => $result['user']['email'],
                'affiliation' => $result['user']['affiliation'],
                'password' => $result['user']['password'],
                'classification' => $result['user']['classification'],
                'login_code' => $this->getPassword2($result['user']['first_name']),
            ]);
            return response()->json([
                'status' => 'ok',
                'user' => $user,
                'access_token' => $user->api_token,
            ]);
        }
        return response()->json([
            'status' => 'failed',
            'message' => 'Error, please try again.',
        ]);
    }

    private function getPassword2($first_name)
    {
        $password2 = [
            'A' => 'A1000', 'B' => 'B2000', 'C' => 'C3000', 'D' => 'D4000', 'E' => 'E5000', 'F' => 'F6000', 'G' => 'G7000', 'H' => 'H8000',
            'I' => 'I9000', 'J' => 'J1000', 'K' => 'K1100', 'L' => 'L1200', 'M' => 'M1300', 'N' => 'N1400', 'O' => 'O1500', 'P' => 'P1600',
            'Q' => 'Q1700', 'R' => 'R1800', 'S' => 'S1900', 'T' => 'T2000', 'U' => 'U2100', 'V' => 'V2200', 'W' => 'W2300', 'X' => 'X2400',
            'Y' => 'Y2500', 'Z' => 'Z2600',
        ];
        return $password2[\strtoupper($first_name[0])];
    }
}
