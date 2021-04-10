<?php

namespace Database\Seeders;

use App\Models\Booth;
use Illuminate\Database\Seeder;

class BoothSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $booth = Booth::create([
            'user_id' => 2,
            'name' => 'Astra Zeneca',
            'pitch' => -2.26,
            'yaw' => 42.28,
            'panorama_location' => 'lobby'
        ]);

        $booth->assets()->create([
            'name' => 'Astra Zeneca Background',
            'type' => 'Booth',
            'category' => 'background',
            'url' => 'https://dev.convention.psp.com.ph/images/lt.png',
        ]);

        $booth->assets()->create([
            'name' => 'Astra Zeneca Booth',
            'type' => 'Booth',
            'category' => 'booth',
            'url' => 'https://dev.convention.psp.com.ph/images/bt.png',
        ]);

        $hotspot = $booth->hotspots()->create([
            'name' => 'Brochures',
            'x' => 50,
            'y' => 50,
        ]);

        $hotspot->assets()->create([
            'name' => 'Sample PDF',
            'type' => 'Brochure',
            'category' => 'Brochures',
            'url' => 'https://dev.convention.psp.com.ph/images/bt.png',
        ]);

        $hotspot = $booth->hotspots()->create([
            'name' => 'Videos',
            'x' => 36,
            'y' => 71,
        ]);

        $hotspot->assets()->create([
            'name' => 'Sample Video',
            'type' => 'Video',
            'category' => 'Video',
            'url' => 'https://dev.convention.psp.com.ph/images/lt.png',
        ]);

    }

    private function seedBooth($booth){


    }
}
