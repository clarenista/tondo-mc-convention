<?php

namespace Database\Seeders;

use App\Models\Booth;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BoothEventCategoryPatch extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (Booth::all() as $booth) {
            if (!$booth->eventCategory) {
                $booth->eventCategory()->create([
                    'name' => Str::slug($booth->name),
                    'description' => $booth->name,
                ]);
            }else{
                $booth->eventCategory()->update([
                    'name' => Str::slug($booth->name),
                    'description' => $booth->name,
                ]);
            }
        }
    }
}
