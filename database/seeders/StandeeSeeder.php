<?php

namespace Database\Seeders;

use App\Models\Booth;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StandeeSeeder extends Seeder
{

    public function run()
    {
        $aws_booth_endpoint = "https://psp-s3bucket.s3-ap-southeast-1.amazonaws.com/Booth/";
        // , "{$aws_booth_endpoint}BG", "{$aws_booth_endpoint}BOOTH"],
        $locations = [

            'Hall A' => [
                // RIGHT
                ['AA', -0.6817179289739342, 35.42225395523985, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['AB', -1.594240506270363, 64.33239878420785, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['AC', -1.1523654149533331, 102.64319216514562, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['AD', -0.8527488757961503, 138.45955910815576, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['AE', -0.5516039911189092, 164.20245586478637, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                // LEFT
                ['AF', -0.18426898163791047, -36.13551032462874, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['AG', -0.5370058401583666, -63.60958009046465, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['AH', -0.9895884399303939, -102.60306603474532, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['AI', -0.4103581540127384, -138.28720221880997, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['AJ', -0.554959933284604, -164.2725944416474, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
            ],

            'Hall B' => [
                // RIGHT
                ['BA', -0.22237344028099243, 37.31801408497495, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['BB', -0.2539430291440301, 67.42461146392172, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['BC', -0.4583931211968272, 106.99366037235411, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['BD', -0.8210048990114792, 140.6798839846046, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['BE', -0.3642578552152887, 165.11161424193364, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                // LEFT
                ['BF', -0.3970637984030077, -37.83889998124772, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['BG', -0.9342984365449882, -67.40570658921104, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['BH', -0.8215879925627744, -106.96993909664928, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['BI', -0.4313705281301858, -140.96395097630665, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['BJ', -0.570219363960319, -165.50651093197598, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
            ],

            'Hall C' => [
                // RIGHT
                ['CA', -0.6601989652106156, 38.08813729498281, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['CB', -0.9135790169028332, 69.38323518140825, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['CC', -0.9097335825995482, 109.32829810300865, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['CD', -0.19539117711344514, 141.88882512086073, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['CE', -0.3468213588926659, 165.58263175620624, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                // LEFT
                ['CF', -0.25734641746618714, -38.97049241072735, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['CG', -0.6508757889461634, -69.51975555219607, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['CH', -0.7451403752758361, -109.21869488627016, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['CI', -0.3509031733134744, -142.08839710981658, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['CJ', -0.4182981051603695, -165.36681366616253, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
            ],

            'Hall D' => [
                // RIGHT
                ['DA', -0.49198944048677595, 37.99509017343631, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['DB', -0.6761483292788999, 69.3148847743567, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['DC', -0.963761153803089, 109.15242161306315, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['DD', -0.3084695569846346, 141.76090422864667, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['DE', -0.5210159686617896, 165.93636850279586, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                // LEFT
                ['DF', -0.35585891825162613, -38.753755544488115, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['DG', -0.4949687180477956, -69.5824482171726, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['DH', -0.537338483340269, -109.12668984503942, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['DI', -0.2080118244048222, -141.96807261339868, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
                ['DJ', -0.5391166728454321, -165.45847222954953, "{$aws_booth_endpoint}SAMPLE-LOGO.jpg"],
            ],
        ];

        foreach ($locations as $location => $booths) {
            foreach ($booths as $booth) {
                Booth::create([
                    'user_id' => 1,
                    'name' => "Standee {$booth[0]} ({$location})",
                    'caption' => "Standee {$booth[0]} ({$location})",
                    'url' => $booth[3],
                    'pitch' => $booth[1],
                    'yaw' => $booth[2],
                    'panorama_location' => Str::snake($location),
                    'type' => 'standee',
                ]);
            }
        }
    }
}
