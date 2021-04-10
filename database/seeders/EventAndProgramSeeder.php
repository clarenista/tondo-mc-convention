<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Program;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (!Event::first()) {
            Event::create([]);
        }
        if (!Program::first()) {
            Program::create([]);
        }
    }
}
