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
                // RIGHT SPONSOR_R1 *updated
                ['MINDRAY', -1.94, 64.19, 'gold', "1618606706-Mindray-BG.png", "1618606709-Mindray+Booth.png",
                    [
                        ['External Link','58','13','https://localhost'],
                        ['Contact Us','81','9',''],
                        ['Quiz','42','72',''],
                        ['Brochures','81','18',''],
                        ['Videos','58','72',''],
                        ['Gallery','47','40',''],
                    ]
                ],

                // SPONSOR_R2
                ['Marsman Drysdale', -1.24, 132.97, 'gold', "BGpng", "BOOTHpng",
                    [
                        ['External Link','58','13','https://localhost'],
                        ['Contact Us','81','19',''],
                        ['Quiz','42','72',''],
                        ['Brochures','81','8',''],
                        ['Videos','58','72',''],
                        ['Gallery','47','38',''],
                    ]
                ],
                // LEFT SPONSOR_L1
                ['Lifeline Diagnostics', -1.29, -46.62, 'gold', "LIFELINE BOOTH BG.png", "	LIFELINE BOOTH.png",
                    [
                        ['External Link','61','12','https://localhost'],
                        ['Contact Us','83','9',''],
                        ['Quiz','30','76',''],
                        ['Brochures','83','19',''],
                        ['Videos','61','75',''],
                        ['Gallery','50','34',''],
                    ]
                ],
                //  SPONSOR_L2
                ['ARKRAY', -1.56, -120.66, 'gold', "Arkray BOOTH BG.png", "Arkray BOOTH.png",
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
                // RIGHT SPONSOR_R1 **FACING POOL AREA ENTRANCE ABOVE ELEVATOR
                ['Ortho Clinical Diagnostics', -0.96, -140.37, 'gold', "Ortho-Clinical-BOOTH-BG.png", "Ortho-Clinical-BOOTH.png",
                    [
                        ['External Link','-16.06','18.78','https://localhost'],
                        ['Contact Us','-9.18','23.15',''],
                        ['Quiz','-10.11','-15.37',''],
                        ['Brochures','-12.06','9.60',''],
                        ['Videos','-0.49','-10.89',''],
                        ['Gallery','-0.60','9.05',''],
                    ]
                ],
                // SPONSOR_R2
                ['BioSystems', 3.63, -89.46, 'silver', "BIOSYSTEM BOOTH BG.png", "BIOSYSTEM BOOTH.png",
                    [
                        ['External Link','-12.21','23.72','https://localhost'],
                        ['Contact Us','-7.95','26.82',''],
                        ['Quiz','-7.71','-12.92',''],
                        ['Brochures','-10.25','17.48',''],
                        ['Videos','0.93','-10.35',''],
                        ['Gallery','-0.38','11.95',''],
                    ]
                ],

                // SPONSOR_R3
                ['SPONSOR_R3', -1.10, -43.86, 'bronze', "BIOSYSTEM BOOTH BG.png", "BIOSYSTEM BOOTH.png",
                    [
                        ['External Link','-15.85','18.98','https://localhost'],
                        ['Contact Us','-9.05','23.71',''],
                        ['Quiz','-10.35','-15.32',''],
                        ['Brochures','-12.10','8.18',''],
                        ['Videos','-0.70','-11.32',''],
                        ['Gallery','-0.71','9.27',''],
                    ]
                ],


                // LEFT SPONSOR_L1
                ['ABBOTT', -0.43, 138.71, 'gold', "Abbot-BOOTH-BG.png", "Abbot-BOOTH.png",
                    [
                        ['External Link','-16.32','18.84','https://localhost'],
                        ['Contact Us','-9.43','23.21',''],
                        ['Quiz','-10.07','-15.07',''],
                        ['Brochures','-12.24','13.33',''],
                        ['Videos','-0.611','-10.94',''],
                        ['Gallery','-0.96','8.97',''],
                    ]
                ],
                // SPONSOR_L2
                ['SIEMENS Healthineers', 0.79, 90.61, 'bronze', "Siemens-BOOTH-BG.png", "Siemens-BOOTH.png",
                    [
                        ['External Link','-16.28','28.31','https://localhost'],
                        ['Contact Us','-10.12','31.33',''],
                        ['Quiz','-9.43','-17.38',''],
                        ['Brochures','-9.94','-4.77',''],
                        ['Videos','1.24','-12.81',''],
                        ['Gallery','-0.27','12.17',''],
                    ]
                ],
                // SPONSOR_L3
                ['Alliend Hospital', 0.4, 44.86, 'bronze', "Allied Hospital BOOTH BG.png", "Allied Hospital BOOTH.png",
                    [
                        ['External Link','-16.28','28.31','https://localhost'],
                        ['Contact Us','-10.12','31.33',''],
                        ['Quiz','-9.43','-17.38',''],
                        ['Brochures','-9.94','-4.77',''],
                        ['Videos','1.24','-12.81',''],
                        ['Gallery','-0.27','12.17',''],
                    ]
                ],
            ],

            'Hall B' => [
                // RIGHT SPONSOR_R1 *FACING LOBBY EXIT
                ['MMJ Biosystems', 0.10, 47.18, 'gold', "MMJ BOOTH BG.png", "MMJ BOOTH.png",
                    [
                        ['External Link','-16.12','19.28','https://localhost'],
                        ['Contact Us','-10.38','24.36',''],
                        ['Quiz','-10.67','15.32',''],
                        ['Brochures','-11.94','10.14',''],
                        ['Videos','-0.38','-10.89',''],
                        ['Gallery','-0.82','9.16',''],
                    ]
                ],
                // SPONSOR_R2
                ['MRL Cybertec', -0.20, 91.04, 'bronze', "MRL BOOTH BG.png", "MRL BOOTH.png",
                    [
                        ['External Link','-12.69','25.05','https://localhost'],
                        ['Contact Us','-8.26','27.31',''],
                        ['Quiz','-8.18','-2.22',''],
                        ['Brochures','-10.23','15.84',''],
                        ['Videos','1.15','-10.35',''],
                        ['Gallery','-0.49','11.64',''],
                    ]
                ],

                // SPONSOR_R3
                ['SPONSOR_R3', 0.20, 137.02, 'silver', "MRL BOOTH BG.png", "MRL BOOTH.png",
                    [
                        ['External Link','-16.13','19.96','https://localhost'],
                        ['Contact Us','-10.03','25',''],
                        ['Quiz','-10.22','-15.84',''],
                        ['Brochures','-12.20','8.51',''],
                        ['Videos','-0.49','-11.32',''],
                        ['Gallery','-0.82','9.38',''],
                    ]
                ],
                // ['BD', -1.31, 125.97, 'silver, "BG", "BOOTH"], // VACANT
                // ['BE', -1.78, 154.53, 'bronze, "BG", "BOOTH"], // VACANT

                // LEFT SPONSOR_L1 
                ['MEDTEK', -0.19, -44.25, 'gold', "MEDTEK BOOTH BG.png", "MEDTEK BOOTH.png",
                    [
                        ['External Link','-15.41','18.27','https://localhost'],
                        ['Contact Us','-10.52','23.71',''],
                        ['Quiz','-10.31','-16.14',''],
                        ['Brochures','-11.59','7.74',''],
                        ['Videos','-0.49','-11.10',''],
                        ['Gallery','-0.60','8.94',''],
                    ]
                ],
                // [SPONSOR_L2
                ['Zafire Distributors', 1.40, -90.00, 'bronze', "ZAFIRE BOOTH BG.png", "ZAFIRE BOOTH.png",
                    [
                        ['External Link','-12.45','21.92','https://localhost'],
                        ['Contact Us','-8.73','25.37',''],
                        ['Quiz','-7.78','-3.78',''],
                        ['Brochures','-9.89','14.18',''],
                        ['Videos','0.92','-11.43',''],
                        ['Gallery','-0.49','10.67',''],
                    ]
                ],
                // SPONSOR_L3
                ['SPONSOR_L3', -0.01, -136.18, 'silver', "Vazyme BOOTH BG.png", "Vazyme BOOTH.png",
                    [
                        ['External Link','-15.57','18.87','https://localhost'],
                        ['Contact Us','-10.09','23.15',''],
                        ['Quiz','-10.09','-16.37',''],
                        ['Brochures','-11.49','7.31',''],
                        ['Videos','-0.49','-11.32',''],
                        ['Gallery','-0.61','8.93',''],
                    ]
                ],
                // ['BJ', -1.35, -125.36, 'silver, "BG", "BOOTH"], // VACANT
                // ['BK', -1.35, -153.34, 'bronze, "BG", "BOOTH"], // VACANT
            ],

            'Hall C' => [
                // RIGHT SPONSOR_R1 *FACING GROUP D
                ['Vazyme', -0.02, 41.64, 'gold', "Vazyme BOOTH BG.png", "Vazyme BOOTH.png",
                    [
                        ['External Link','-0.49','-10.78','https://localhost'],
                        ['Contact Us','-11.98','8.73',''],
                        ['Quiz','-0.93','9.81',''],
                        ['Brochures','-15.41','19.58',''],
                        ['Videos','-10.34','24.92',''],
                        ['Gallery','-10.28','-14.81',''],
                    ]
                ],
                // SPONSOR_R2
                ['Omnibus', 0.14, 90.17, 'bronze', "Omnibus BOOTH BG.png", "Omnibus BOOTH.png",
                    [
                        ['External Link','-12.48','24.83','https://localhost'],
                        ['Contact Us','-8.62','28.21',''],
                        ['Quiz','-7.79','-2.00',''],
                        ['Brochures','-9.91','17.88',''],
                        ['Videos','1.04','-9.92',''],
                        ['Gallery','-0.16','12.28',''],
                    ]
                ],

                // SPONSOR_R3
                ['SPONSOR_R3', -0.20, 139.16, 'silver', "Omnibus BOOTH BG.png", "Omnibus BOOTH.png",
                    [
                        ['External Link','-15.87','20.64','https://localhost'],
                        ['Contact Us','-10.36','25.82',''],
                        ['Quiz','-10.67','-15.20',''],
                        ['Brochures','-11.85','9.49',''],
                        ['Videos','-0.38','-10.57',''],
                        ['Gallery','-0.60','9.38',''],
                    ]
                ],

                // LEFT SPONSOR_L1
                ['Biosite', 0.19, -42.14, 'gold', "Biosite BOOTH BG.png", "Biosite BOOTH.png",
                    [
                        ['External Link','-15.55','17.87','https://localhost'],
                        ['Contact Us','-10.07','23.24',''],
                        ['Quiz','10.42','-16.04',''],
                        ['Brochures','-11.92','7.30',''],
                        ['Videos','-0.49','-11.10',''],
                        ['Gallery','-0.82','8.84',''],
                    ]
                ],
                // SPONSOR_L2
                ['SPONSOR_L2', 2.65, -89.18, 'bronze', "Sysmex BOOTH BG.png", "Sysmex BOOTH.png",
                    [
                        ['External Link','-12.77','21.52','https://localhost'],
                        ['Contact Us','-8.93','25.27',''],
                        ['Quiz','-7.77','-4.11',''],
                        ['Brochures','-10.06','14.80',''],
                        ['Videos','0.81','-11.64',''],
                        ['Gallery','-0.16','10.57',''],
                    ]
                ],

                // SPONSOR_L3
                ['SPONSOR_L3', 0.36, -139.26, 'bronze', "Sysmex BOOTH BG.png", "Sysmex BOOTH.png",
                    [
                        ['External Link','-15.54','18.08','https://localhost'],
                        ['Contact Us','-11.39','7.31',''],
                        ['Quiz','-10.52','-16.25',''],
                        ['Brochures','-11.83','6.54',''],
                        ['Videos','-0.92','-11.32',''],
                        ['Gallery','-0.71','8.40',''],
                    ]
                ],
                // ['CJ', -1.35, -125.36, 'silver, "BG", "BOOTH"],
                // ['CK', -1.35, -153.34, 'bronze, "BG", "BOOTH"],
            ],

            'Hall D' => [
                // SPONSOR_R1 *FACING PSP BOOTH
                ['SPONSOR_R1', 0.31, 41.76, 'bronze', "Sysmex BOOTH BG.png", "Sysmex BOOTH.png",
                    [
                        ['External Link','-15.60','20.66','https://localhost'],
                        ['Contact Us','-10.45','25.83',''],
                        ['Quiz','-10.48','-14.91',''],
                        ['Brochures','-11.82','10.46',''],
                        ['Videos','-0.38','-10.35',''],
                        ['Gallery','-0.71','9.38',''],
                    ]
                ],

                // SPONSOR_R2
                ['SPONSOR_R2', 0.68, 90.05, 'bronze', "Sysmex BOOTH BG.png", "Sysmex BOOTH.png",
                    [
                        ['External Link','-12.29','25.74','https://localhost'],
                        ['Contact Us','-8.75','28.90',''],
                        ['Quiz','-7.91','-1.00',''],
                        ['Brochures','-9.85','18.98',''],
                        ['Videos','1.15','-9.60',''],
                        ['Gallery','0.16','12.60',''],
                    ]
                ],

                // SPONSOR_R3
                ['SPONSOR_R3', -1.40, 136.23, 'bronze', "Sysmex BOOTH BG.png", "Sysmex BOOTH.png",
                    [
                        ['External Link','-15.56','21.05','https://localhost'],
                        ['Contact Us','-10.19','25.46',''],
                        ['Quiz','-10.67','-15.22',''],
                        ['Brochures','-11.73','10.14',''],
                        ['Videos','-0.60','-10.24',''],
                        ['Gallery','-0.49','9.7',''],
                    ]
                ],

                // SPONSOR_L1 *FACING PSP BOOTH
                ['SPONSOR_L1', -0.65, -41.11, 'bronze', "Sysmex BOOTH BG.png", "Sysmex BOOTH.png",
                    [
                        ['External Link','-15.96','17.78','https://localhost'],
                        ['Contact Us','-10.34','23.62',''],
                        ['Quiz','-10.64','-17.68',''],
                        ['Brochures','-11.60','7.20',''],
                        ['Videos','-0.59','-11.75',''],
                        ['Gallery','-0.82','8.62SPONSOR_L2',''],
                    ]
                ],

                // SPONSOR_L2
                ['SPONSOR_L2', 1.21, -88.83, 'bronze', "Sysmex BOOTH BG.png", "Sysmex BOOTH.png",
                    [
                        ['External Link','-12.48','21.63','https://localhost'],
                        ['Contact Us','-9.26','24.92',''],
                        ['Quiz','-7.89','-4.33',''],
                        ['Brochures','-9.75','14.81',''],
                        ['Videos','1.03','-11.85',''],
                        ['Gallery','-0.16','10.03',''],
                    ]
                ],

                // SPONSOR_L3
                ['SPONSOR_L3', -0.08, -138.18, 'bronze', "Sysmex BOOTH BG.png", "Sysmex BOOTH.png",
                    [
                        ['External Link','-15.76','17.78','https://localhost'],
                        ['Contact Us','-10.31','22.68',''],
                        ['Quiz','-10.36','-17.17',''],
                        ['Brochures','-11.27','7.96',''],
                        ['Videos','-0.70','-11.53',''],
                        ['Gallery','-0.60','8.51',''],
                    ]
                ],

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
                'hotspots' => $booth[6],
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
