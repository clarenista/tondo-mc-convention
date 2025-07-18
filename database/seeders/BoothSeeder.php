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
                ['ALJERON Medical', -2.13, -62.90, 'gold', "ALJERON.png", "ALJERON.png",
                    [
                        ['External Link', '-12.03','-27.98','https://aljeronmedical.com'],
                        ['Contact Us','-7.11','-24.67',''],
                        ['Quiz', '-7.11','-31.91',''],
                        ['Brochures', '-11.95','22.34',''],
                        ['Videos', '-1.69','0.92',''],
                        ['Gallery', '-1.33','-16.02','']
                    ]
                ],

                // green
                ['CORBRIDGE', -1.31, -126.56, 'gold', "CORBRIDGE.png", "CORBRIDGE.png",
                    [
                        ['External Link', '-11.43','-27.89','https://sample.website.com'],
                        ['Contact Us','-6.81','-25.10',''],
                        ['Quiz', '-6.81','-31.09',''],
                        ['Brochures', '-11.57','22.43',''],
                        ['Videos', '-1.69','0.82',''],
                        ['Gallery', '-2.81','-16.02','']
                    ]
                ],
                // blue
                ['DKT', 0.54, 126.37, 'gold', "DKT.png", "DKT.png",
                    [
                        ['External Link', '-12.09','-26.59','https://trust.ph'],
                        ['Contact Us','-6.84','-24.59',''],
                        ['Quiz', '-6.84','-30.78',''],
                        ['Brochures', '-11.57','22.43',''],
                        ['Videos', '-1.69','0.92',''],
                        ['Gallery', '-4.59','-15.73','']
                    ]
                ],
                //  pink
                ['BSV', -0.28, 59.73, 'gold', "BSV.png", "BSV.png",
                    [
                        ['External Link', '-11.99','-26.68','https://bsvbioscience.ph'],
                        ['Contact Us','-6.80','-25.18',''],
                        ['Quiz', '-6.80','-30.78',''],
                        ['Brochures', '-11.57','22.51',''],
                        ['Videos', '-1.69','0.92',''],
                        ['Gallery', '-2.63','-14.68','']
                    ]
                ],
            ],

            'Hall A' => [
                // left facing lobby/ hall a exit
                ['MEDEV', -0.69, -55.27, 'bronze', "MEDEV.png", "MEDEV.png",
                    [
                        ['External Link', '-15.38','-14.14','https://medev.com.ph'],
                        ['Contact Us','-9.36','-6.93',''],
                        ['Quiz', '-8.38','-18.01',''],
                        ['Brochures', '-1.68','-3.50',''],
                        ['Videos', '-2.19','10.67',''],
                        ['Gallery', '-1.68','-12.85','']
                    ]
                ],

                ['NPK', -0.82, -89.71, 'silver', "NPK.png", "NPK.png",
                    [
                        ['External Link', '-14.64','-19.15','https://npkmedical.ph'],
                        ['Contact Us','-8.62','-10.57',''],
                        ['Quiz', '-7.73','-26.06',''],
                        ['Brochures', '-2.19','14.83',''],
                        ['Videos', '-2.20','-14.82',''],
                        ['Gallery', '-1.36','-1.40','']
                    ]
                ],

                // SPONSOR_R2
                ['Hi-Precision', -0.75, -126.16, 'bronze', "Hi-Precision.png", "Hi-Precision.png",
                    [
                        ['External Link', '-15.62','-13.63','https://hi-precision.com.ph'],
                        ['Contact Us','-9.58','-6.93',''],
                        ['Quiz', '-8.52','-17.68',''],
                        ['Brochures', '-3.00','-2.77',''],
                        ['Videos', '-1.87','10.58',''],
                        ['Gallery', '-3.00','-13.71','']
                    ]
                ],

                // SPONSOR_R3
                ['Tondo Medical Center', -2.34, -179.85, 'gold', "tondoMC.png", "tondoMC.png",
                    [
                        ['External Link', '-10.84','-29.08','https://tmc.doh.gov.ph'],
                        ['Contact Us','-6.99','-21.78',''],
                        ['Quiz', '-6.12','-34.22',''],
                        ['Brochures', '-11.77','22.33',''],
                        ['Videos', '-1.81','0.99',''],
                        ['Gallery', '-2.63','-16.00','']
                    ]
                ],


                // LEFT SPONSOR_L4
                ['Multicare', -1.65, 124.73, 'bronze', "Multicare.png", "Multicare.png",
                    [
                        ['External Link', '-15.28','-13.80','https://journeytomotherhoodandbeyond.info'],
                        ['Contact Us','-9.23','-6.75',''],
                        ['Quiz', '-8.81','-17.10',''],
                        ['Brochures', '-1.18','-1.59',''],
                        ['Videos', '-2.41','11.19',''],
                        ['Gallery', '-1.16','-11.11','']
                    ]
                ],
                // SPONSOR_L5
                ['Toyo Adtec', -0.72, 55.80, 'bronze', "Toyo_Adtec.png", "Toyo_Adtec.png",
                    [
                        ['External Link', '-15.11','-13.88','https://tahealthcaregroup.com'],
                        ['Contact Us','-9.32','-6.84',''],
                        ['Quiz', '-8.35','-17.68',''],
                        ['Brochures', '-2.81','-2.86',''],
                        ['Videos', '-2.14','10.50',''],
                        ['Gallery', '-2.81','-13.54','']
                    ]
                ],

                //SPONSOR_L6
                ['MedEthix', -1.11, 91.43, 'bronze', "MedEthix.png", "MedEthix.png",
                    [
                        ['External Link', '-15.11','-13.88','https://medethix.com.ph'],
                        ['Contact Us','-9.32','-6.84',''],
                        ['Quiz', '-9.32','-17.68',''],
                        ['Brochures', '-2.81','-2',''],
                        ['Videos', '-2.14','10.50',''],
                        ['Gallery', '-2.81','-13.54','']
                    ]
                ],

                // // SPONSOR_L7
                // ['MUREX', -0.93, 79.06, 'silver', "MUREX.png", "MUREX.png",
                //     [
                //         ['External Link', '-15.07','-24.02','https://murexdiagnostics.com'],
                //         ['Contact Us', '-5.09','-17.95',''],
                //         ['Quiz','-5.09', '-29.08',''],
                //         ['Brochures', '1.59','4.82',''],
                //         ['Videos', '1.46','36.26',''],
                //         ['Gallery', '1.59','-6.23',''],
                //     ]
                // ],
                // // SPONSOR_L8
                // ['RHUMBA INC.', -0.97, 49.44, 'silver', "RHUMBA.png", "RHUMBA.png",
                //     [
                //         ['External Link', '-13.98','-15.73','https://rhumba-inc.com'],
                //         ['Contact Us', '-5.08','-13.00',''],
                //         ['Quiz','-5.08', '-22.45',''],
                //         ['Brochures', '1.66','-4.96',''],
                //         ['Videos', '1.073','13.20',''],
                //         ['Gallery', '1.66','-14.07',''],
                //     ]
                // ],
            ],

            // 'Hall B' => [
            //     // left facing lobby/ hall a exit
            //     ['Biosite', -1.40, -47.56, 'silver', "Biosite.png", "Biosite.png",
            //         [
            //             ['External Link', '-13.43','-16.32','https://www.facebook.com/biositemedicalinstruments/'],
            //             ['Contact Us', '-5.10','-11.50',''],
            //             ['Quiz','-5.10', '-21.23',''],
            //             ['Brochures', '1.45','-3.97',''],
            //             ['Videos', '0.93','13.67',''],
            //             ['Gallery', '1.45','-14.01',''],
            //         ]
            //     ],
            //     // SPONSOR_R2
            //     ['Grepcore Diamonde', -1.75, -79.71, 'silver', "Grepcore.png", "Grepcore.png",
            //         [
            //             ['External Link', '-14.07','-19.73','https://grepcordiamonde.com.ph'],
            //             ['Contact Us', '-5.03','-15.20',''],
            //             ['Quiz', '-5.03', '-23.90',''],
            //             ['Brochures', '1.94','-4.54',''],
            //             ['Videos', '0.93','11.78',''],
            //             ['Gallery', '1.94','-15.67',''],
            //         ]
            //     ],

            //     // SPONSOR_R3
            //     ['Marsman Drysdale', -1.25, -117.84, 'silver', "Marsman.png", "Marsman.png",
            //         [
            //             ['External Link', '-13.74','-19.04','https://mdmpi.com.ph'],
            //             ['Contact Us', '-5.03','-15.14',''],
            //             ['Quiz','-5.03', '-23.90',''],
            //             ['Brochures', '1.80','-4.40',''],
            //             ['Videos', '1.07','11.71',''],
            //             ['Gallery', '1.80','-16.32',''],
            //         ]
            //     ],


            //     // LEFT SPONSOR_L4
            //     ['ARKRAY', -1.39, -148.88, 'silver', "ARKRAY.png", "ARKRAY.png",
            //         [
            //             ['External Link', '-9.79','-12.73','https://arkray.ph'],
            //             ['Contact Us', '-3.35','-12.93',''],
            //             ['Quiz', '-3.35', '-21.48',''],
            //             ['Brochures', '0.60','3.83',''],
            //             ['Videos', '1.17','26.52',''],
            //             ['Gallery', '0.60','-6.02',''],

            //         ]
            //     ],
            //     // SPONSOR_L5
            //     ['Snibe Diagnostics', -2.21, 151.25, 'silver', "Snibe.png", "Snibe.png",
            //         [
            //             ['External Link', '-9.38','-15.93','https://snibe.com'],
            //             ['Contact Us', '-3.26','-14.61',''],
            //             ['Quiz','-3.26', '-22.82',''],
            //             ['Brochures', '0.81','3.05',''],
            //             ['Videos', '1.19','24.96',''],
            //             ['Gallery', '0.81','-6.79',''],             ]
            //     ],
            //     // SPONSOR_L6
            //     ['MINDRAY', -0.74, 120.19, 'silver', "MINDRAY.png", "MINDRAY.png",
            //         [
            //             ['External Link', '-14.17','-14.81','https://mindray.com'],
            //             ['Contact Us', '-5.03','-12.05',''],
            //             ['Quiz','-5.03', '-21.84',''],
            //             ['Brochures', '1.88','-3.19',''],
            //             ['Videos', '0.93','13.54',''],
            //             ['Gallery', '1.88','-15.60',''],                  ]
            //     ],
            //     // SPONSOR_L7
            //     ['ERBA', -1.43, 80.49, 'silver', "ERBA.png", "ERBA.png",
            //         [
            //             ['External Link', '-14.81','-22.39','https://erbamannheim.com'],
            //             ['Contact Us', '-5.03','-17.75',''],
            //             ['Quiz','-5.03', '-29.29',''],
            //             ['Brochures', '1.45','4.54',''],
            //             ['Videos', '1.46','36.12',''],
            //             ['Gallery', '1.45','-6.44',''],
            //         ]
            //     ],
            //     // SPONSOR_L8
            //     ['OMNIBUS', -0.80, 48.30, 'silver', "OMNIBUS.png", "OMNIBUS.png",
            //         [
            //             ['External Link', '-14.15','-15.20','https://omnibus.ph'],
            //             ['Contact Us', '-5.08','-12.79',''],
            //             ['Quiz','-5.08', '-22.52',''],
            //             ['Brochures', '0.60','-4.89',''],
            //             ['Videos', '1.00','13.20',''],
            //             ['Gallery', '0.60','-12.79',''],
            //         ]
            //     ],
            // ],

            // 'Hall C' => [
            //     // left facing lobby/ hall C exit
            //     ['Zafire', -0.04, -46.67, 'silver', "Zafire.png", "Zafire.png",
            //         [
            //             ['External Link', '-14.12','-16.52','https://zafire.com.ph'],
            //             ['Contact Us', '-4.96','-15.07',''],
            //             ['Quiz', '-4.96', '-24.37',''],
            //             ['Brochures', '1.94','-5.60',''],
            //             ['Videos', '1.00','11.78',''],
            //             ['Gallery', '1.94','-16.26',''],
            //         ]
            //     ],
            //     // SPONSOR_R2
            //     ['ALLIED', -0.42, -78.37, 'silver', "ALLIED.png", "ALLIED.png",
            //         [
            //             ['External Link', '-14.53','-16.19','https://alliedhospitalsupply.com'],
            //             ['Contact Us', '-5.10','-11.78',''],
            //             ['Quiz','-5.10', '-21.78',''],
            //             ['Brochures', '1.45','-3.90',''],
            //             ['Videos', '0.93','13.67',''],
            //             ['Gallery', '1.45','-15.73',''],
            //         ]
            //     ],

            //     // SPONSOR_R3
            //     ['Biosystems', -0.25, -118.97, 'silver', "Biosystems.png", "Biosystems.png",
            //         [
            //             ['External Link', '-13.53','-19.29','https://localhost'],
            //             ['Contact Us', '-4.96','-15.01',''],
            //             ['Quiz','-4.96', '-24.31',''],
            //             ['Brochures', '2.08','-5.46',''],
            //             ['Videos', '1.14','11.78',''],
            //             ['Gallery', '2.08','-16.78',''],
            //         ]
            //     ],


            //     // LEFT SPONSOR_L4
            //     ['FAS', -0.09, -149.77, 'silver', "FAS.png", "FAS.png",
            //         [
            //             ['External Link', '-10.08','-11.98','https://fas.ph'],
            //             ['Contact Us', '-3.21','-13.06',''],
            //             ['Quiz','-3.21', '-21.04',''],
            //             ['Brochures', '0.95','2.98',''],
            //             ['Videos', '1.11','26.52',''],
            //             ['Gallery', '0.95','-4.96',''],

            //         ]
            //     ],
            //     // SPONSOR_L5
            //     ['VITALINE', -0.26, 149.55, 'silver', "VITALINE.png", "VITALINE.png",
            //         [
            //             ['External Link', '-9.62','-20.17','https://vitalinehealthcareinc.com'],
            //             ['Contact Us', '-3.05','-14.94',''],
            //             ['Quiz','-3.05', '-22.39',''],
            //             ['Brochures', '1.38','2.06',''],
            //             ['Videos', '1.12','24.96',''],
            //             ['Gallery', '1.38','-5.74',''],
            //         ]
            //     ],
            //     // SPONSOR_L6
            //     ['SYSMEX', -0.11, 120.84, 'silver', "SYSMEX.png", "SYSMEX.png",
            //         [
            //             ['External Link', '-14.55','-15.01','https://sysmex.co.jp'],
            //             ['Contact Us', '-4.89','-11.71',''],
            //             ['Quiz','-4.89', '-21.84',''],
            //             ['Brochures', '2.80','-2.62',''],
            //             ['Videos', '1.00','13.67',''],
            //             ['Gallery', '2.80','-14.87',''],
            //         ]
            //     ],
            //     // SPONSOR_L7
            //     ['Thermo Fisher', -0.48, 79.82, 'silver', "Thermo.png", "Thermo.png",
            //         [
            //             ['External Link', '-15.04','-15.34','https://thermofisher.com'],
            //             ['Contact Us', '-5.23','-12.18',''],
            //             ['Quiz','-5.23', '-22.39',''],
            //             ['Brochures', '1.73','-3.48',''],
            //             ['Videos', '0.93','13.47',''],
            //             ['Gallery', '1.73','-15.07',''],
            //         ]
            //     ],
            //     // SPONSOR_L8
            //     ['BLUE CROSS', -0.23, 48.32, 'silver', "BLUE.png", "BLUE.png",
            //         [
            //             ['External Link', '-14.66','-17.82','https://bluecrossphilippines.com'],
            //             ['Contact Us', '-5.08','-12.86',''],
            //             ['Quiz','-5.08', '-22.76',''],
            //             ['Brochures', '2.30','-4.40',''],
            //             ['Videos', '0.93',' 12.93',''],
            //             ['Gallery', '2.30','-14.94',''],
            //         ]
            //     ],
            // ],

            // 'Hall D' => [
            //     // left facing lobby/ hall C exit
            //     // ['L1', -0.24, -46.18, 'silver', "L1.png", "L1.png",
            //     //     [
            //     //         ['External Link','-16.06','18.78','https://localhost'],
            //     //         ['Contact Us','-9.18','23.15',''],
            //     //         ['Quiz','-10.11','-15.37',''],
            //     //         ['Brochures','-12.06','9.60',''],
            //     //         ['Videos','-0.49','-10.89',''],
            //     //         ['Gallery','-0.60','9.05',''],
            //     //     ]
            //     // ],
            //     // // SPONSOR_R2
            //     // ['L2', 0.40, -79.55, 'silver', "L2.png", "L2.png",
            //     //     [
            //     //         ['External Link','-12.21','23.72','https://localhost'],
            //     //         ['Contact Us','-7.95','26.82',''],
            //     //         ['Quiz','-7.71','-12.92',''],
            //     //         ['Brochures','-10.25','17.48',''],
            //     //         ['Videos','0.93','-10.35',''],
            //     //         ['Gallery','-0.38','11.95',''],
            //     //     ]
            //     // ],



            //     // // SPONSOR_R3
            //     // ['L3',  0.24, -119.20, 'silver', "L3.png", "L3.png",
            //     //     [
            //     //         ['External Link','-15','-20',''],
            //     //         ['Contact Us','-9','-24',''],
            //     //         ['Quiz','-11','12',''],
            //     //         ['Brochures','-4','-10',''],
            //     //         ['Videos','-1','9',''],
            //     //         ['Gallery','2','-10',''],
            //     //     ]
            //     // ],


            //     // LEFT SPONSOR_L4
            //     ['Philippine Society of Pathologist', 0.77, -178.92, 'silver', "psp.png", "psp.png",
            //         [
            //             ['External Link', '-6.67','-28.69','https://psp.com.ph'],
            //             ['Contact Us', '-1.88','-21.84',''],
            //             ['Quiz','-1.88', '-32.89',''],
            //             ['Brochures', '-5.89','29.35',''],
            //             ['Videos', '4.05','19.10',''],
            //             ['Gallery', '0.78','-16.19',''],
            //         ]
            //     ],
            //     // SPONSOR_L5
            //     ['Pathologist Residents Organization', 0.22, 120.41, 'silver', "pro.png", "pro.png",
            //         [
            //             ['External Link', '-13.55','-27.25','https://localhost'],
            //             ['Contact Us', '-4.78','-16.85',''],
            //             ['Quiz','-4.78', '-28.64',''],
            //             ['Brochures', '1.02','3.55',''],
            //             ['Videos', '1.12','35.94',''],
            //             ['Gallery', '1.02','-4.68',''],
            //         ]
            //     ],
            //     // SPONSOR_L6
            //     // ['R1', 0.06, 77.43, 'silver', "R1.png", "R1.png",
            //     //     [
            //     //         ['External Link','-16','20',''],
            //     //         ['Contact Us','-10','24',''],
            //     //         ['Quiz','-10','-14',''],
            //     //         ['Brochures','-4','9',''],
            //     //         ['Videos','-1','-11',''],
            //     //         ['Gallery','2','9',''],
            //     //     ]
            //     // ],
            //     // // SPONSOR_L7
            //     // ['R2', -0.71, 47.80, 'silver', "R2.png", "R2.png",
            //     //     [
            //     //         ['External Link','-16','20',''],
            //     //         ['Contact Us','-10','24',''],
            //     //         ['Quiz','-10','-14',''],
            //     //         ['Brochures','-4','9',''],
            //     //         ['Videos','-1','-11',''],
            //     //         ['Gallery','2','9',''],
            //     //     ]
            //     // ],
            //     // SPONSOR_L8
            //     // ['BLUE CROSS', -0.23, 48.32, 'silver', "BLUE.png", "BLUE.png",
            //     //     [
            //     //         ['External Link','-16','20',''],
            //     //         ['Contact Us','-10','24',''],
            //     //         ['Quiz','-10','-14',''],
            //     //         ['Brochures','-4','9',''],
            //     //         ['Videos','-1','-11',''],
            //     //         ['Gallery','2','9',''],
            //     //     ]
            //     // ],

            // ],
        ];


        foreach ($locations as $location => $booths) {
            foreach ($booths as $booth) {

                $ln = $location == "Hall A" ? "Exhibit Hall" : $location;
                $booth_name = "Booth {$booth[0]} ({$location})";
                if (!User::whereName($booth_name)->exists()) {
                    $this->seedBooth(User::create([
                        'name' => "{$booth[0]} Booth ({$ln})",
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

        $aws_booth_endpoint = "https://s3-ap-southeast-1.amazonaws.com/tmc-s3bucket/Booth/";
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
