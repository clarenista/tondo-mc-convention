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
                ['MINDRAY', -2.26, 42.28, 'gold', "{$aws_booth_endpoint}1618606706-Mindray-BG.png", "{$aws_booth_endpoint}1618606709-Mindray+Booth.png"],
                // ['B', -2.00, 129.05, 'gold', '', ''],
                // LEFT
                // ['C', -1.74, -41.12, 'gold', '', ''],
                // ['D', -1.94, -127.23, 'gold', '', ''],
            ],

            'Hall A' => [
                // RIGHT
                ['Ortho Clinical Diagnostics', -0.19, 25.83, 'gold', "{$aws_booth_endpoint}Ortho-Clinical-BOOTH-BG.png", "{$aws_booth_endpoint}Ortho-Clinical-BOOTH.png"],
                // ['AB', -1.54, 52.11, 'silver'],
                // ['AC', -2.27, 90.40, 'bronze'],
                // ['AD', -1.31, 125.97, 'silver'],
                // ['AE', -1.78, 154.53, 'bronze'],
                // LEFT
                ['ABBOTT', -0.22, -23.34, 'gold', "{$aws_booth_endpoint}Abbot-BOOTH-BG.png", "{$aws_booth_endpoint}Abbot-BOOTH.png"],
                // ['AG', -1.17, -51.66, 'silver'],
                ['SIEMENS Healthineers', -2.08, -89.27, 'bronze', "{$aws_booth_endpoint}Siemens-BOOTH-BG.png", "{$aws_booth_endpoint}Siemens-BOOTH.png"],
                // ['AJ', -1.35, -125.36, 'silver'],
                // ['AK', -1.35, -153.34, 'bronze'],
            ],

            'Hall B' => [
                // RIGHT
                ['MMJ Biosystems', -0.19, 25.83, 'gold', "{$aws_booth_endpoint}MMJ BOOTH BG.png", "{$aws_booth_endpoint}MMJ BOOTH.png"],
                // ['BB', -1.54, 52.11, 'silver'],
                // ['BC', -2.27, 90.40, 'bronze'],
                // ['BD', -1.31, 125.97, 'silver'],
                // ['BE', -1.78, 154.53, 'bronze'],
                // LEFT
                ['MEDTEK', -0.22, -23.34, 'gold', "{$aws_booth_endpoint}MEDTEK BOOTH BG.png", "{$aws_booth_endpoint}MEDTEK BOOTH.png"],
                // ['BG', -1.17, -51.66, 'silver'],
                // ['BH', -2.08, -89.27, 'bronze'],
                // ['BJ', -1.35, -125.36, 'silver'],
                // ['BK', -1.35, -153.34, 'bronze'],
            ],

            'Hall C' => [
                // RIGHT
                // ['CA', -0.19, 25.83, 'gold'],
                // ['CB', -1.54, 52.11, 'silver'],
                // ['CC', -2.27, 90.40, 'bronze'],
                // ['CD', -1.31, 125.97, 'silver'],
                // ['CE', -1.78, 154.53, 'bronze'],
                // LEFT
                // ['CF', -0.22, -23.34, 'gold'],
                // ['CG', -1.17, -51.66, 'silver'],
                // ['CH', -2.08, -89.27, 'bronze'],
                // ['CJ', -1.35, -125.36, 'silver'],
                // ['CK', -1.35, -153.34, 'bronze'],
            ],

            'Hall D' => [
                // RIGHT
                // ['DA', -0.19, 25.83, 'gold'],
                // ['DB', -1.54, 52.11, 'silver'],
                // ['DC', -2.27, 90.40, 'bronze'],
                // ['DD', -1.31, 125.97, 'silver'],
                // ['DE', -1.78, 154.53, 'bronze'],
                // LEFT
                // ['DF', -0.22, -23.34, 'gold'],
                // ['DG', -1.17, -51.66, 'silver'],
                // ['DH', -2.08, -89.27, 'bronze'],
                // ['DJ', -1.35, -125.36, 'silver'],
                // ['DK', -1.35, -153.34, 'bronze'],
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
                $user->booth->assets()->whereCategory('background')->first()->update(['url' => $booth[4]]);
            }
            if (isset($booth[5])) {
                $user->booth->assets()->whereCategory('booth')->first()->update(['url' => $booth[5]]);
            }
            $user->assignRole('sponsor');
        } catch (\Throwable $th) {
            dd($th->errors());
        }
    }
}
