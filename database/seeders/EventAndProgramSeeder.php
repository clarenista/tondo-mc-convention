<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Program;
use Illuminate\Database\Seeder;

class EventAndProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (!Event::first()) {
            Event::create([
                'start_at' => '2021-04-10 08:00:00',
                'end_at' => '2021-05-10 08:00:00',
            ]);
        }
        if (!Program::first()) {
            Program::create([
                'start_at' => '2021-04-10 08:00:00',
                'end_at' => '2021-05-10 08:00:00',
            ]);
        }
    }
}
