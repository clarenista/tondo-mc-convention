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
                // from right to left - facing the booths -> orange
                ['SNIBE', -0.42, -34.38, 'gold', "snibe.png.png", "snibe.png.png",
                    [
                        ['External Link','-14','6',''],
                        ['Contact Us','-9','34',''],
                        ['Quiz','-6','-18',''],
                        ['Brochures','-5','-28',''],
                        ['Videos','-3','7',''],
                        ['Gallery','2','-28',''],
                    ]
                ],

                // green
                ['Thermo Fisher Scientific', -0.91, -68.92, 'gold', "thermofisher.png", "thermofisher.png",
                    [
                        ['External Link','-14','-6',''],
                        ['Contact Us','-8','-34',''],
                        ['Quiz','-6','17',''],
                        ['Brochures','-5','29',''],
                        ['Videos','-1','-7',''],
                        ['Gallery','2','26',''],
                    ]
                ],
                // blue
                ['BIOCARE', -0.72, -106.76, 'gold', "biocare.png", "biocare.png",
                    [
                        ['External Link','-14','-6',''],
                        ['Contact Us','-8','-34',''],
                        ['Quiz','-6','17',''],
                        ['Brochures','-5','26',''],
                        ['Videos','-1','-7',''],
                        ['Gallery','1','26',''],
                    ]
                ],
                //  pink
                ['ROCHE', -0.19, -134.06, 'gold', "roche.png.png", "roche.png.png",
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
                // left facing lobby/ hall a exit
                ['MEDTEK', -1.73, -48.56, 'silver', "MEDTEK.png", "MEDTEK.png",
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
                ['LifelineDiagnostics', -2.35, -78.09, 'silver', "LifelineDiagnostics.png", "LifelineDiagnostics.png",
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
                ['AGAPPE', -1.81, -115.98, 'silver', "AGAPPE.png", "AGAPPE.png",
                    [
                        ['External Link','-15','-20',''],
                        ['Contact Us','-9','-24',''],
                        ['Quiz','-11','12',''],
                        ['Brochures','-4','-10',''],
                        ['Videos','-1','9',''],
                        ['Gallery','2','-10',''],
                    ]
                ],


                // LEFT SPONSOR_L4
                ['Ortho Clinical Diagnostics', -1.89, -150.59, 'silver', "Ortho.png", "Ortho.png",
                    [
                        ['External Link','-15','-20',''],
                        ['Contact Us','-9','-24',''],
                        ['Quiz','-11','12',''],
                        ['Brochures','-4','-10',''],
                        ['Videos','-1','10',''],
                        ['Gallery','1','-10',''],
                    ]
                ],
                // SPONSOR_L5
                ['Abbott', -2.53, 148.75, 'silver', "Abbott.png", "Abbott.png",
                    [
                        ['External Link','-14','3',''],
                        ['Contact Us','-9','32',''],
                        ['Quiz','-7','-20',''],
                        ['Brochures','-7','-27',''],
                        ['Videos','-3','6',''],
                        ['Gallery','0','-27',''],
                    ]
                ],
                // SPONSOR_L6
                ['I.T. EASY SOFTWARE SOLUTIONS INC.', -1.56, 118.42, 'silver', "it_easy.png", "it_easy.png",
                    [
                        ['External Link','-16','20',''],
                        ['Contact Us','-10','24',''],
                        ['Quiz','-10','-14',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
                    ]
                ],
                // SPONSOR_L7
                ['MUREX', -0.93, 79.06, 'silver', "MUREX.png", "MUREX.png",
                    [
                        ['External Link','-16','20',''],
                        ['Contact Us','-10','24',''],
                        ['Quiz','-10','-14',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
                    ]
                ],
                // SPONSOR_L8
                ['RHUMBA INC.', -0.97, 49.44, 'silver', "RHUMBA.png", "RHUMBA.png",
                    [
                        ['External Link','-16','20',''],
                        ['Contact Us','-10','24',''],
                        ['Quiz','-10','-14',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
                    ]
                ],
            ],

            'Hall B' => [
                // left facing lobby/ hall a exit
                ['Biosite', -1.40, -47.56, 'silver', "Biosite.png", "Biosite.png",
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
                ['Grepcore Diamonde', -1.75, -79.71, 'silver', "Grepcore.png", "Grepcore.png",
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
                ['Marsman Drysdale', -1.25, -117.84, 'silver', "Marsman.png", "Marsman.png",
                    [
                        ['External Link','-15','-20',''],
                        ['Contact Us','-9','-24',''],
                        ['Quiz','-11','12',''],
                        ['Brochures','-4','-10',''],
                        ['Videos','-1','9',''],
                        ['Gallery','2','-10',''],
                    ]
                ],


                // LEFT SPONSOR_L4
                ['ARKRAY', -1.39, -148.88, 'silver', "ARKRAY.png", "ARKRAY.png",
                    [
                        ['External Link','-15','-20',''],
                        ['Contact Us','-9','-24',''],
                        ['Quiz','-11','12',''],
                        ['Brochures','-4','-10',''],
                        ['Videos','-1','10',''],
                        ['Gallery','1','-10',''],
                    ]
                ],
                // SPONSOR_L5
                ['Snibe Diagnostics', -2.21, 151.25, 'silver', "Snibe.png", "Snibe.png",
                    [
                        ['External Link','-14','3',''],
                        ['Contact Us','-9','32',''],
                        ['Quiz','-7','-20',''],
                        ['Brochures','-7','-27',''],
                        ['Videos','-3','6',''],
                        ['Gallery','0','-27',''],
                    ]
                ],
                // SPONSOR_L6
                ['MINDRAY', -0.74, 120.19, 'silver', "MINDRAY.png", "MINDRAY.png",
                    [
                        ['External Link','-16','20',''],
                        ['Contact Us','-10','24',''],
                        ['Quiz','-10','-14',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
                    ]
                ],
                // SPONSOR_L7
                ['ERBA', -1.43, 80.49, 'silver', "ERBA.png", "ERBA.png",
                    [
                        ['External Link','-16','20',''],
                        ['Contact Us','-10','24',''],
                        ['Quiz','-10','-14',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
                    ]
                ],
                // SPONSOR_L8
                ['OMNIBUS', -0.80, 48.30, 'silver', "OMNIBUS.png", "OMNIBUS.png",
                    [
                        ['External Link','-16','20',''],
                        ['Contact Us','-10','24',''],
                        ['Quiz','-10','-14',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
                    ]
                ],
            ],

            'Hall C' => [
                // left facing lobby/ hall C exit
                ['IMAGE ICON', -0.04, -46.67, 'silver', "IMAGE.png", "IMAGE.png",
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
                ['ALLIED', -0.42, -78.37, 'silver', "ALLIED.png", "ALLIED.png",
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
                ['Biosystems', -0.25, -118.97, 'silver', "Biosystems.png", "Biosystems.png",
                    [
                        ['External Link','-15','-20',''],
                        ['Contact Us','-9','-24',''],
                        ['Quiz','-11','12',''],
                        ['Brochures','-4','-10',''],
                        ['Videos','-1','9',''],
                        ['Gallery','2','-10',''],
                    ]
                ],


                // LEFT SPONSOR_L4
                ['FAS', -0.09, -149.77, 'silver', "FAS.png", "FAS.png",
                    [
                        ['External Link','-15','-20',''],
                        ['Contact Us','-9','-24',''],
                        ['Quiz','-11','12',''],
                        ['Brochures','-4','-10',''],
                        ['Videos','-1','10',''],
                        ['Gallery','1','-10',''],
                    ]
                ],
                // SPONSOR_L5
                ['VITALINE', -0.26, 149.55, 'silver', "VITALINE.png", "VITALINE.png",
                    [
                        ['External Link','-14','3',''],
                        ['Contact Us','-9','32',''],
                        ['Quiz','-7','-20',''],
                        ['Brochures','-7','-27',''],
                        ['Videos','-3','6',''],
                        ['Gallery','0','-27',''],
                    ]
                ],
                // SPONSOR_L6
                ['SYSMEX', -0.11, 120.84, 'silver', "SYSMEX.png", "SYSMEX.png",
                    [
                        ['External Link','-16','20',''],
                        ['Contact Us','-10','24',''],
                        ['Quiz','-10','-14',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
                    ]
                ],
                // SPONSOR_L7
                ['Thermo Fisher', -0.48, 79.82, 'silver', "Thermo.png", "Thermo.png",
                    [
                        ['External Link','-16','20',''],
                        ['Contact Us','-10','24',''],
                        ['Quiz','-10','-14',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
                    ]
                ],
                // SPONSOR_L8
                ['BLUE CROSS', -0.23, 48.32, 'silver', "BLUE.png", "BLUE.png",
                    [
                        ['External Link','-16','20',''],
                        ['Contact Us','-10','24',''],
                        ['Quiz','-10','-14',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
                    ]
                ],
            ],

            'Hall D' => [
                // left facing lobby/ hall C exit
                ['L1', -0.24, -46.18, 'silver', "L1.png", "L1.png",
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
                ['L2', 0.40, -79.55, 'silver', "L2.png", "L2.png",
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
                ['L3',  0.24, -119.20, 'silver', "L3.png", "L3.png",
                    [
                        ['External Link','-15','-20',''],
                        ['Contact Us','-9','-24',''],
                        ['Quiz','-11','12',''],
                        ['Brochures','-4','-10',''],
                        ['Videos','-1','9',''],
                        ['Gallery','2','-10',''],
                    ]
                ],


                // LEFT SPONSOR_L4
                ['Philippine Society of Pathologist', 0.77, -178.92, 'silver', "psp.png", "psp.png",
                    [
                        ['External Link','-15','-20',''],
                        ['Contact Us','-9','-24',''],
                        ['Quiz','-11','12',''],
                        ['Brochures','-4','-10',''],
                        ['Videos','-1','9',''],
                        ['Gallery','2','-10',''],
                    ]
                ],
                // SPONSOR_L5
                ['Pathologist Residents Organization', 0.22, 120.41, 'silver', "pro.png", "pro.png",
                    [
                        ['External Link','-14','3',''],
                        ['Contact Us','-9','32',''],
                        ['Quiz','-7','-20',''],
                        ['Brochures','-7','-27',''],
                        ['Videos','-3','6',''],
                        ['Gallery','0','-27',''],
                    ]
                ],
                // SPONSOR_L6
                ['R1', 0.06, 77.43, 'silver', "R1.png", "R1.png",
                    [
                        ['External Link','-16','20',''],
                        ['Contact Us','-10','24',''],
                        ['Quiz','-10','-14',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
                    ]
                ],
                // SPONSOR_L7
                ['R2', -0.71, 47.80, 'silver', "R2.png", "R2.png",
                    [
                        ['External Link','-16','20',''],
                        ['Contact Us','-10','24',''],
                        ['Quiz','-10','-14',''],
                        ['Brochures','-4','9',''],
                        ['Videos','-1','-11',''],
                        ['Gallery','2','9',''],
                    ]
                ],
                // SPONSOR_L8
                // ['BLUE CROSS', -0.23, 48.32, 'silver', "BLUE.png", "BLUE.png",
                //     [
                //         ['External Link','-16','20',''],
                //         ['Contact Us','-10','24',''],
                //         ['Quiz','-10','-14',''],
                //         ['Brochures','-4','9',''],
                //         ['Videos','-1','-11',''],
                //         ['Gallery','2','9',''],
                //     ]
                // ],

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
