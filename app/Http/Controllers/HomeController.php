<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // $credentials = $request->only('email', 'password');
        $user = User::with('booth')->where('email_address', $request->email_address)->first();
        if ($user) {
            if (!$user->api_token) {
                $user->update(['api_token' => hash('sha256', Str::random(80))]);
            }
            Auth::login($user);
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

    function passwordRemind(Request $request)
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
        $response = $guzzle->post(config('app.domain') . '/api/convention-password-remind', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . json_decode((string) $token->getBody(), true)['access_token'],
            ],
            'form_params' => [
                'email' => $request->email,
                'domain' => 'https://convention.psp.com.ph',
            ],
        ]);
        $result = json_decode((string) $response->getBody(), true);
        if ($result) {
            return response()->json([
                'status' => 'ok',
            ]);
        }
    }

    function resetPassword(Request $request)
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
        $response = $guzzle->post(config('app.domain') . '/api/reset-password', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . json_decode((string) $token->getBody(), true)['access_token'],
            ],
            'form_params' => [
                'password' => $request->password,
                'reset_password_key' => $request->reset_password_key,
            ],
        ]);
        $result = json_decode((string) $response->getBody(), true);
        // dd($result);   
        if ($result) {
            $user = User::where('registrant_id', $result['user']['id'])->first();
            $user->password = $result['user']['password'];
            $user->save();
            return response()->json([
                'status' => 'ok',
            ]);
        }
    }
}
