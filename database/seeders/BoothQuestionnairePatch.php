<?php

namespace Database\Seeders;

use App\Models\Booth;
use Illuminate\Database\Seeder;

class BoothQuestionnairePatch extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach(Booth::all() as $booth){
            if(!$booth->questionnaire){
                $booth->questionnaire()->create([
                    'name' => $booth->name . " Quiz",
                    'description' => $booth->name . " Quiz",
                    'category' => "Quiz",
                ]);
            }
        }
    }
}
