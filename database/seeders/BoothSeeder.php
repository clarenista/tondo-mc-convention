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
                ['MINDRAY', -2.26, 42.28, 'gold', "1618606706-Mindray-BG.png", "1618606709-Mindray+Booth.png",
                    [
                        ['External Link','58','13','https://localhost'],
                        ['Contact Us','81','9',''],
                        ['Quiz','42','72',''],
                        ['Brochures','81','18',''],
                        ['Videos','58','72',''],
                        ['Gallery','47','40',''],
                    ]
                ],
                    
                // UPDATE BOOTH
                ['Marsman Drysdale', -2.00, 129.05, 'gold', "BGpng", "BOOTHpng", 
                    [
                        ['External Link','58','13','https://localhost'],
                        ['Contact Us','81','19',''],
                        ['Quiz','42','72',''],
                        ['Brochures','81','8',''],
                        ['Videos','58','72',''],
                        ['Gallery','47','38',''],
                    ]
                ],
                // LEFT
                ['Lifeline Diagnostics', -1.74, -41.12, 'gold', "LIFELINE BOOTH BG.png", "	LIFELINE BOOTH.png",
                    [
                        ['External Link','61','12','https://localhost'],
                        ['Contact Us','83','9',''],
                        ['Quiz','30','76',''],
                        ['Brochures','83','19',''],
                        ['Videos','61','75',''],
                        ['Gallery','50','34',''],
                    ]
                ],
                ['ARKRAY', -1.94, -127.23, 'gold', "Arkray BOOTH BG.png", "Arkray BOOTH.png",
                    [
                        ['External Link','58','13','https://localhost'],
                        ['Contact Us','82','10',''],
                        ['Quiz','31','73',''],
                        ['Brochures','82','19',''],
                        ['Videos','58','73',''],
                        ['Gallery','47','38',''],
                    ]
                ],
            ],

            'Hall A' => [
                // RIGHT
                ['Ortho Clinical Diagnostics', -0.19, 25.83, 'gold', "Ortho-Clinical-BOOTH-BG.png", "Ortho-Clinical-BOOTH.png",
                    [
                        ['External Link','58','11','https://localhost'],
                        ['Contact Us','82','9',''],
                        ['Quiz','42','73',''],
                        ['Brochures','82','18',''],
                        ['Videos','57','73',''],
                        ['Gallery','40','33',''],
                    ]
                ],
                // ['AB', -1.54, 52.11, 'silver', "BG", "BOOTH"], // VACANT
                ['BioSystems', -2.27, 90.40, 'bronze', "BIOSYSTEM BOOTH BG.png", "BIOSYSTEM BOOTH.png",
                    [
                        ['External Link','54','22','https://localhost'],
                        ['Contact Us','84','75',''],
                        ['Quiz','25','64',''],
                        ['Brochures','73','75',''],
                        ['Videos','40','64',''],
                        ['Gallery','39','46',''],
                    ]
                ],
                // ['AD', -1.31, 125.97, 'silver', "BG", "BOOTH"], // VACANT
                // ['AE', -1.78, 154.53, 'bronze', "BG", "BOOTH"], // VACANT
                // LEFT
                ['ABBOTT', -0.22, -23.34, 'gold', "Abbot-BOOTH-BG.png", "Abbot-BOOTH.png",
                    [
                        ['External Link','60','13','https://localhost'],
                        ['Contact Us','83','10',''],
                        ['Quiz','32','77',''],
                        ['Brochures','83','20',''],
                        ['Videos','46','75',''],
                        ['Gallery','36','33',''],
                    ]
                ],
                // ['AG', -1.17, -51.66, 'silver, "BG", "BOOTH"], // VACANT
                ['SIEMENS Healthineers', -2.08, -89.27, 'bronze', "Siemens-BOOTH-BG.png", "Siemens-BOOTH.png",
                    [
                        ['External Link','54','22','https://localhost'],
                        ['Contact Us','84','74',''],
                        ['Quiz','25','64',''],
                        ['Brochures','73','74',''],
                        ['Videos','40','63',''],
                        ['Gallery','44','42',''],
                    ]
                ],
                // ['AJ', -1.35, -125.36, 'silver, "BG", "BOOTH"], // VACANT
                ['Alliend Hospital', -1.35, -153.34, 'bronze', "Allied Hospital BOOTH BG.png", "Allied Hospital BOOTH.png",
                    [
                        ['External Link','54','23','https://localhost'],
                        ['Contact Us','84','74',''],
                        ['Quiz','25','64',''],
                        ['Brochures','73','74',''],
                        ['Videos','42','64',''],
                        ['Gallery','51','43',''],
                    ]
                ],
            ],

            'Hall B' => [
                // RIGHT
                ['MMJ Biosystems', -0.19, 25.83, 'gold', "MMJ BOOTH BG.png", "MMJ BOOTH.png",
                    [
                        ['External Link','60','13','https://localhost'],
                        ['Contact Us','81','10',''],
                        ['Quiz','34','67',''],
                        ['Brochures','81','19',''],
                        ['Videos','58','75',''],
                        ['Gallery','47','40',''],
                    ]
                ],
                // ['BB', -1.54, 52.11, 'silver, "BG", "BOOTH"], // VACANT
                ['MRL Cybertec', -2.27, 90.40, 'bronze', "MRL BOOTH BG.png", "MRL BOOTH.png",
                    [
                        ['External Link','54','23','https://localhost'],
                        ['Contact Us','84','74',''],
                        ['Quiz','25','64',''],
                        ['Brochures','73','74',''],
                        ['Videos','42','64',''],
                        ['Gallery','42','45',''],
                    ]
                ],
                // ['BD', -1.31, 125.97, 'silver, "BG", "BOOTH"], // VACANT
                // ['BE', -1.78, 154.53, 'bronze, "BG", "BOOTH"], // VACANT
                // LEFT
                ['MEDTEK', -0.22, -23.34, 'gold', "MEDTEK BOOTH BG.png", "MEDTEK BOOTH.png",
                    [
                        ['External Link','59','15','https://localhost'],
                        ['Contact Us','80','12',''],
                        ['Quiz','31','75',''],
                        ['Brochures','80','21',''],
                        ['Videos','58','74',''],
                        ['Gallery','48','40',''],
                    ]
                ],
                // ['BG', -1.17, -51.66, 'silver, "BG", "BOOTH"], // VACANT
                ['Zafire Distributors', -2.08, -89.27, 'bronze', "ZAFIRE BOOTH BG.png", "ZAFIRE BOOTH.png",
                    [
                        ['External Link','54','23','https://localhost'],
                        ['Contact Us','84','75',''],
                        ['Quiz','25','64',''],
                        ['Brochures','73','75',''],
                        ['Videos','40','64',''],
                        ['Gallery','38','46',''],
                    ]
                ],
                // ['BJ', -1.35, -125.36, 'silver, "BG", "BOOTH"], // VACANT
                // ['BK', -1.35, -153.34, 'bronze, "BG", "BOOTH"], // VACANT
            ],

            'Hall C' => [
                // RIGHT
                ['Vazyme', -0.19, 25.83, 'gold', "Vazyme BOOTH BG.png", "Vazyme BOOTH.png",
                    [
                        ['External Link','60','10','https://localhost'],
                        ['Contact Us','82','8',''],
                        ['Quiz','32','74',''],
                        ['Brochures','82','17',''],
                        ['Videos','60','75',''],
                        ['Gallery','48','36',''],
                    ]
                ],
                // ['CB', -1.54, 52.11, 'silver, "BG", "BOOTH"],
                ['Omnibus', -2.27, 90.40, 'bronze', "Omnibus BOOTH BG.png", "Omnibus BOOTH.png",
                    [
                        ['External Link','53','22','https://localhost'],
                        ['Contact Us','84','74',''],
                        ['Quiz','25','64',''],
                        ['Brochures','73','74',''],
                        ['Videos','41','63',''],
                        ['Gallery','39','45',''],
                    ]
                ],
                // ['CD', -1.31, 125.97, 'silver, "BG", "BOOTH"],
                // ['CE', -1.78, 154.53, 'bronze, "BG", "BOOTH"],
                // LEFT
                ['Biosite', -0.22, -23.34, 'gold', "Biosite BOOTH BG.png", "Biosite BOOTH.png",
                    [
                        ['External Link','58','13','https://localhost'],
                        ['Contact Us','81','11',''],
                        ['Quiz','34','72',''],
                        ['Brochures','81','20',''],
                        ['Videos','60','73',''],
                        ['Gallery','47','36',''],
                    ]
                ],
                // ['CG', -1.17, -51.66, 'silver, "BG", "BOOTH"],
                ['SYSMEX', -2.08, -89.27, 'bronze', "Sysmex BOOTH BG.png", "Sysmex BOOTH.png",
                    [
                        ['External Link','55','22','https://localhost'],
                        ['Contact Us','84','74',''],
                        ['Quiz','27','64',''],
                        ['Brochures','73','74',''],
                        ['Videos','43','64',''],
                        ['Gallery','45','41',''],
                    ]
                ],
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
