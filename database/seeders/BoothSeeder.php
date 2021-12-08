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
                ['SNIBE', -1.94, 64.19, 'gold', "snibe.png.png", "snibe.png.png",
                    [
                        ['External Link','-14','6',''],
                        ['Contact Us','-9','34',''],
                        ['Quiz','-6','-18',''],
                        ['Brochures','-5','-28',''],
                        ['Videos','-3','7',''],
                        ['Gallery','2','-28',''],
                    ]
                ],

                // SPONSOR_R2
                ['Thermo Fisher Scientific', -1.24, 126.80, 'gold', "thermofisher.png", "thermofisher.png",
                    [
                        ['External Link','-14','-6',''],
                        ['Contact Us','-8','-34',''],
                        ['Quiz','-6','17',''],
                        ['Brochures','-5','29',''],
                        ['Videos','-1','-7',''],
                        ['Gallery','2','26',''],
                    ]
                ],
                // LEFT SPONSOR_L1
                ['BIOCARE', -1.29, -56.62, 'gold', "biocare.png", "biocare.png",
                    [
                        ['External Link','-14','-6',''],
                        ['Contact Us','-8','-34',''],
                        ['Quiz','-6','17',''],
                        ['Brochures','-5','26',''],
                        ['Videos','-1','-7',''],
                        ['Gallery','1','26',''],
                    ]
                ],
                //  SPONSOR_L2
                ['ROCHE', -1.56, -120.66, 'gold', "roche.png.png", "roche.png.png",
                    [
                        ['External Link','-14','8',''],
                        ['Contact Us','-9','34',''],
                        ['Quiz','-6','-18',''],
                        ['Brochures','-5','-26',''],
                        ['Videos','-3','7',''],
                        ['Gallery','2','-26',''],
                    ]
                ],
            ],

            'Hall A' => [
                // RIGHT SPONSOR_R1 **FACING POOL AREA ENTRANCE ABOVE ELEVATOR
                // ['SPONSOR_R1', -0.96, -140.37, 'bronze', "SPONSOR_R1.png", "SPONSOR_R1.png",
                //     [
                //         ['External Link','-16.06','18.78','https://localhost'],
                //         ['Contact Us','-9.18','23.15',''],
                //         ['Quiz','-10.11','-15.37',''],
                //         ['Brochures','-12.06','9.60',''],
                //         ['Videos','-0.49','-10.89',''],
                //         ['Gallery','-0.60','9.05',''],
                //     ]
                // ],
                // SPONSOR_R2
                // ['SPONSOR_R2', 3.63, -89.46, 'gold', "SPONSOR_R2.png", "SPONSOR_R2.png",
                //     [
                //         ['External Link','-12.21','23.72','https://localhost'],
                //         ['Contact Us','-7.95','26.82',''],
                //         ['Quiz','-7.71','-12.92',''],
                //         ['Brochures','-10.25','17.48',''],
                //         ['Videos','0.93','-10.35',''],
                //         ['Gallery','-0.38','11.95',''],
                //     ]
                // ],

                // SPONSOR_R3
                ['Allied Hospital', -1, -49.36, 'bronze', "allied.png", "allied.png",
                    [
                        ['External Link','-15','-20',''],
                        ['Contact Us','-9','-24',''],
                        ['Quiz','-11','12',''],
                        ['Brochures','-4','-10',''],
                        ['Videos','-1','9',''],
                        ['Gallery','2','-10',''],
                    ]
                ],


                // LEFT SPONSOR_L1
                ['Touchstar', -0.43, 133.45, 'bronze', "touchstar.png", "touchstar.png",
                    [
                        ['External Link','-15','-20',''],
                        ['Contact Us','-9','-24',''],
                        ['Quiz','-11','12',''],
                        ['Brochures','-4','-10',''],
                        ['Videos','-1','10',''],
                        ['Gallery','1','-10',''],
                    ]
                ],
                // SPONSOR_L2
                ['SIEMENS Healthineers', 0.79, 90.61, 'gold', "siemens-healthineers.png", "siemens-healthineers.png",
                    [
                        ['External Link','-14','3',''],
                        ['Contact Us','-9','32',''],
                        ['Quiz','-7','-20',''],
                        ['Brochures','-7','-27',''],
                        ['Videos','-3','6',''],
                        ['Gallery','0','-27',''],
                    ]
                ],
                // SPONSOR_L3
                ['I.T. EASY SOFTWARE SOLUTIONS INC.', -0.36, 47.02, 'bronze', "it_easy.png", "it_easy.png",
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
                // ['SPONSOR_R1', 0.10, 47.18, 'bronze', "SPONSOR_R1.png", "SPONSOR_R1.png",
                //     [
                //         ['External Link','-16.12','19.28','https://localhost'],
                //         ['Contact Us','-10.38','24.36',''],
                //         ['Quiz','-10.67','15.32',''],
                //         ['Brochures','-11.94','10.14',''],
                //         ['Videos','-0.38','-10.89',''],
                //         ['Gallery','-0.82','9.16',''],
                //     ]
                // ],
                // SPONSOR_R2
                // ['SPONSOR_R2', -0.20, 91.04, 'gold', "SPONSOR_R2.png", "SPONSOR_R2.png",
                //     [
                //         ['External Link','-12.69','25.05','https://localhost'],
                //         ['Contact Us','-8.26','27.31',''],
                //         ['Quiz','-8.18','-2.22',''],
                //         ['Brochures','-10.23','15.84',''],
                //         ['Videos','1.15','-10.35',''],
                //         ['Gallery','-0.49','11.64',''],
                //     ]
                // ],

                // SPONSOR_R3
                ['RHUMBA INC.', 0.20, 134.02, 'bronze', "rhumba.png", "rhumba.png",
                    [
                        ['External Link','-15','-24',''],
                        ['Contact Us','-9','-25',''],
                        ['Quiz','-6','-11',''],
                        ['Brochures','-7','26',''],
                        ['Videos','-1','11',''],
                        ['Gallery','2','26',''],
                    ]
                ],
                // ['BD', -1.31, 125.97, 'silver, "BG", "BOOTH"], // VACANT
                // ['BE', -1.78, 154.53, 'bronze, "BG", "BOOTH"], // VACANT

                // LEFT SPONSOR_L1 
                ['MRL Cybertech', -0.19, -47.85, 'bronze', "mrl-cybertec.png", "mrl-cybertec.png",
                    [
                        ['External Link','-16','-20',''],
                        ['Contact Us','-9','-25',''],
                        ['Quiz','-11','13',''],
                        ['Brochures','-4','-10',''],
                        ['Videos','-1','10',''],
                        ['Gallery','2','-10',''],
                    ]
                ],
                // [SPONSOR_L2
                ['Ortho Clinical Diagnostics', 1.40, -90.00, 'gold', "ortho-clinical.png", "ortho-clinical.png",
                    [
                        ['External Link','-14','8',''],
                        ['Contact Us','-8','34',''],
                        ['Quiz','-7','-17',''],
                        ['Brochures','-7','-24',''],
                        ['Videos','-3','8',''],
                        ['Gallery','0','-24',''],
                    ]
                ],
                // SPONSOR_L3
                // ['SPONSOR_L3', -0.01, -136.18, 'bronze', "SPONSOR_L3.png", "SPONSOR_L3.png",
                //     [
                //         ['External Link','-15.57','18.87','https://localhost'],
                //         ['Contact Us','-10.09','23.15',''],
                //         ['Quiz','-10.09','-16.37',''],
                //         ['Brochures','-11.49','7.31',''],
                //         ['Videos','-0.49','-11.32',''],
                //         ['Gallery','-0.61','8.93',''],
                //     ]
                // ],
                // ['BJ', -1.35, -125.36, 'silver, "BG", "BOOTH"], // VACANT
                // ['BK', -1.35, -153.34, 'bronze, "BG", "BOOTH"], // VACANT
            ],

            'Hall C' => [
                // RIGHT SPONSOR_R1 *FACING GROUP D
                ['Biosystems', -0.02, 46, 'bronze', "biosystem.png", "biosystem.png",
                    [
                        ['External Link','-16','20',''],
                        ['Contact Us','-10','24',''],
                        ['Quiz','-10','-14',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
                    ]
                ],
                // SPONSOR_R2
                // ['SPONSOR_R2', 0.14, 90.17, 'gold', "SPONSOR_R2.png", "SPONSOR_R2.png",
                //     [
                //         ['External Link','-12.48','24.83','https://localhost'],
                //         ['Contact Us','-8.62','28.21',''],
                //         ['Quiz','-7.79','-2.00',''],
                //         ['Brochures','-9.91','17.88',''],
                //         ['Videos','1.04','-9.92',''],
                //         ['Gallery','-0.16','12.28',''],
                //     ]
                // ],

                // SPONSOR_R3
                ['BIOSITE', -0.20, 132.65, 'bronze', "biosite.png", "biosite.png",
                    [
                        ['External Link','-15','-24',''],
                        ['Contact Us','-9','-25',''],
                        ['Quiz','-6','-11',''],
                        ['Brochures','-7','26',''],
                        ['Videos','-1','11',''],
                        ['Gallery','2','26',''],
                    ]
                ],

                // LEFT SPONSOR_L1
                ['GLOBE BUSINESS', 0.19, -46.14, 'bronze', "globe-buisiness.png", "globe-buisiness.png",
                    [
                        ['External Link','-15','-24',''],
                        ['Contact Us','-9','-25',''],
                        ['Quiz','-6','-11',''],
                        ['Brochures','-7','26',''],
                        ['Videos','-1','11',''],
                        ['Gallery','2','26',''],
                    ]
                ],
                // SPONSOR_L2
                ['BIOREMIEUX PHILIPPINES CORPORATION', 2.65, -89.18, 'gold', "biomerieux.png", "biomerieux.png",
                    [
                        ['External Link','-14','5',''],
                        ['Contact Us','-9','32',''],
                        ['Quiz','-7','-19',''],
                        ['Brochures','-7','-27',''],
                        ['Videos','-3','6',''],
                        ['Gallery','0','-27',''],
                    ]
                ],

                // SPONSOR_L3
                // ['SPONSOR_L3', 0.36, -139.26, 'bronze', "SPONSOR_L3.png", "SPONSOR_L3.png",
                //     [
                //         ['External Link','-15.54','18.08','https://localhost'],
                //         ['Contact Us','-11.39','7.31',''],
                //         ['Quiz','-10.52','-16.25',''],
                //         ['Brochures','-11.83','6.54',''],
                //         ['Videos','-0.92','-11.32',''],
                //         ['Gallery','-0.71','8.40',''],
                //     ]
                // ],
                // ['CJ', -1.35, -125.36, 'silver, "BG", "BOOTH"],
                // ['CK', -1.35, -153.34, 'bronze, "BG", "BOOTH"],
            ],

            'Hall D' => [
                // SPONSOR_R1 *FACING PSP BOOTH
                // ['SPONSOR_R1', 0.31, 41.76, 'bronze', "SPONSOR_R1.png", "SPONSOR_R1.png",
                //     [
                //         ['External Link','-15.60','20.66','https://localhost'],
                //         ['Contact Us','-10.45','25.83',''],
                //         ['Quiz','-10.48','-14.91',''],
                //         ['Brochures','-11.82','10.46',''],
                //         ['Videos','-0.38','-10.35',''],
                //         ['Gallery','-0.71','9.38',''],
                //     ]
                // ],

                // SPONSOR_R2
                ['Grepcore Diamonde', 0.68, 90.05, 'gold', "grepcor.png", "grepcor.png",
                    [
                        ['External Link','-8','-1',''],
                        ['Contact Us','-5','32',''],
                        ['Quiz','-8','-15',''],
                        ['Brochures','0','-1',''],
                        ['Videos','2','22',''],
                        ['Gallery','0','-15',''],
                    ]
                ],

                // SPONSOR_R3
                // ['SPONSOR_R3', -1.40, 136.23, 'bronze', "SPONSOR_R3.png", "SPONSOR_R3.png",
                //     [
                //         ['External Link','-15.56','21.05','https://localhost'],
                //         ['Contact Us','-10.19','25.46',''],
                //         ['Quiz','-10.67','-15.22',''],
                //         ['Brochures','-11.73','10.14',''],
                //         ['Videos','-0.60','-10.24',''],
                //         ['Gallery','-0.49','9.7',''],
                //     ]
                // ],

                // SPONSOR_L1 *FACING PSP BOOTH
                ['Philippine Society of Pathologist Inc.', 2.54, 0.28, 'gold', "psp.png", "psp.png",
                    [
                        ['External Link','-13','4',''],
                        ['Contact Us','-7','32',''],
                        ['Quiz','-5','-19',''],
                        ['Brochures','-5','-27',''],
                        ['Videos','-1','6',''],
                        ['Gallery','3','-27',''],
                    ]
                ],

                // // SPONSOR_L2
                ['Pathology Residents Organization', -0.33, -46.28, 'bronze', "pro.png", "pro.png",
                    [
                        ['External Link','-16','-20',''],
                        ['Contact Us','-9','-25',''],
                        ['Quiz','-11','13',''],
                        ['Brochures','-4','-10',''],
                        ['Videos','-1','10',''],
                        ['Gallery','2','-10',''],
                    ]
                ],

                // SPONSOR_L3
                ['MUREX', -0.08, -132.18, 'bronze', "murex.png", "murex.png",
                    [
                        ['External Link','-16','19',''],
                        ['Contact Us','-10','23',''],
                        ['Quiz','-10','-15',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
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
