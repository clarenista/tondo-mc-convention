<?php

namespace Database\Seeders;

use App\Http\Controllers\Cms\BoothController;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BoothSeeder extends Seeder
{

    public function run()
    {
        $aws_booth_endpoint = "https://psp-s3bucket.s3-ap-southeast-1.amazonaws.com/Booth/";
        // , "{$aws_booth_endpoint}BG", "{$aws_booth_endpoint}BOOTH"],
        $locations = [
            'Lobby' => [
                // RIGHT
                ['MINDRAY', -2.26, 42.28, 'gold', "1618606706-Mindray-BG.png", "1618606709-Mindray+Booth.png"],
                // UPDATE BOOTH
                // ['Marsman Drysdale', -2.00, 129.05, 'gold', "BG", "BOOTH"],
                // LEFT
                ['Lifeline Diagnostics', -1.74, -41.12, 'gold', "LIFELINE BOOTH BG.png", "	LIFELINE BOOTH.png"],
                ['ARKRAY', -1.94, -127.23, 'gold', "Arkray BOOTH BG.png", "Arkray BOOTH.png"],
            ],

            'Hall A' => [
                // RIGHT
                ['Ortho Clinical Diagnostics', -0.19, 25.83, 'gold', "Ortho-Clinical-BOOTH-BG.png", "Ortho-Clinical-BOOTH.png"],
                // ['AB', -1.54, 52.11, 'silver', "BG", "BOOTH"], // VACANT
                ['BioSystems', -2.27, 90.40, 'bronze', "BIOSYSTEM BOOTH BG.png", "BIOSYSTEM BOOTH.png"],
                // ['AD', -1.31, 125.97, 'silver', "BG", "BOOTH"], // VACANT
                // ['AE', -1.78, 154.53, 'bronze', "BG", "BOOTH"], // VACANT
                // LEFT
                ['ABBOTT', -0.22, -23.34, 'gold', "Abbot-BOOTH-BG.png", "Abbot-BOOTH.png"],
                // ['AG', -1.17, -51.66, 'silver, "BG", "BOOTH"], // VACANT
                ['SIEMENS Healthineers', -2.08, -89.27, 'bronze', "Siemens-BOOTH-BG.png", "Siemens-BOOTH.png"],
                // ['AJ', -1.35, -125.36, 'silver, "BG", "BOOTH"], // VACANT
                ['Alliend Hospital', -1.35, -153.34, 'bronze', "Allied Hospital BOOTH BG.png", "Allied Hospital BOOTH.png"],
            ],

            'Hall B' => [
                // RIGHT
                ['MMJ Biosystems', -0.19, 25.83, 'gold', "MMJ BOOTH BG.png", "MMJ BOOTH.png"],
                // ['BB', -1.54, 52.11, 'silver, "BG", "BOOTH"], // VACANT
                ['MRL Cybertec', -2.27, 90.40, 'bronze', "MRL BOOTH BG.png", "MRL BOOTH.png"],
                // ['BD', -1.31, 125.97, 'silver, "BG", "BOOTH"], // VACANT
                // ['BE', -1.78, 154.53, 'bronze, "BG", "BOOTH"], // VACANT
                // LEFT
                ['MEDTEK', -0.22, -23.34, 'gold', "MEDTEK BOOTH BG.png", "MEDTEK BOOTH.png"],
                // ['BG', -1.17, -51.66, 'silver, "BG", "BOOTH"], // VACANT
                ['Zafire Distributors', -2.08, -89.27, 'bronze', "ZAFIRE BOOTH BG.png", "ZAFIRE BOOTH.png"],
                // ['BJ', -1.35, -125.36, 'silver, "BG", "BOOTH"], // VACANT
                // ['BK', -1.35, -153.34, 'bronze, "BG", "BOOTH"], // VACANT
            ],

            'Hall C' => [
                // RIGHT
                // ['CA', -0.19, 25.83, 'gold, "BG", "BOOTH"],
                // ['CB', -1.54, 52.11, 'silver, "BG", "BOOTH"],
                // ['CC', -2.27, 90.40, 'bronze, "BG", "BOOTH"],
                // ['CD', -1.31, 125.97, 'silver, "BG", "BOOTH"],
                // ['CE', -1.78, 154.53, 'bronze, "BG", "BOOTH"],
                // LEFT
                // ['CF', -0.22, -23.34, 'gold, "BG", "BOOTH"],
                // ['CG', -1.17, -51.66, 'silver, "BG", "BOOTH"],
                // ['CH', -2.08, -89.27, 'bronze, "BG", "BOOTH"],
                // ['CJ', -1.35, -125.36, 'silver, "BG", "BOOTH"],
                // ['CK', -1.35, -153.34, 'bronze, "BG", "BOOTH"],
            ],

            'Hall D' => [
                // RIGHT
                // ['DA', -0.19, 25.83, 'gold, "BG", "BOOTH"], // VACANT
                // ['DB', -1.54, 52.11, 'silver, "BG", "BOOTH"], // VACANT
                // ['DC', -2.27, 90.40, 'bronze, "BG", "BOOTH"], // VACANT
                // ['DD', -1.31, 125.97, 'silver, "BG", "BOOTH"], // VACANT
                // ['DE', -1.78, 154.53, 'bronze, "BG", "BOOTH"], // VACANT
                // LEFT
                // ['DF', -0.22, -23.34, 'gold, "BG", "BOOTH"], // VACANT
                // ['DG', -1.17, -51.66, 'silver, "BG", "BOOTH"], // VACANT
                // ['DH', -2.08, -89.27, 'bronze, "BG", "BOOTH"], // VACANT
                // ['DJ', -1.35, -125.36, 'silver, "BG", "BOOTH"], // VACANT
                // ['DK', -1.35, -153.34, 'bronze, "BG", "BOOTH"], // VACANT
            ],
        ];

        foreach ($locations as $location => $booths) {
            foreach ($booths as $booth) {
                $booth_name = "Booth {$booth[0]} ({$location})";
                if (!User::whereName($booth_name)->exists()) {
                    $this->seedBooth(User::create([
                        'name' => "{$booth[0]} Booth ({$location})",
                        'first_name' => "{$booth[0]} Booth",
                        'last_name' => $location,
                        'email' => "sponsor_" . strtolower($booth[0]),
                        'password' => Hash::make("sponsor_" . strtolower($booth[0])),
                        'classification' => 'sponsor',
                    ]), $booth, $location);
                }
            }
        }
    }

    private function seedBooth($user, $booth, $location)
    {

        $aws_booth_endpoint = "https://psp-s3bucket.s3-ap-southeast-1.amazonaws.com/Booth/";
        try {
            (new BoothController)->store(new Request([
                'user_id' => $user->id,
                'name' => $user->name,
                'pitch' => $booth[1],
                'yaw' => $booth[2],
                'panorama_location' => Str::snake($location),
                'type' => $booth[3],
            ]));
            if (isset($booth[4])) {
                $user->booth->assets()->whereCategory('background')->first()->update(['url' => "{$aws_booth_endpoint}$booth[4]"]);
            }
            if (isset($booth[5])) {
                $user->booth->assets()->whereCategory('booth')->first()->update(['url' => "{$aws_booth_endpoint}$booth[5]"]);
            }
            $user->assignRole('sponsor');
        } catch (\Throwable $th) {
            dd($th->errors());
        }
    }
}
