<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class Guest2ndPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password2 =
            [
            'A' => 'A1000',
            'B' => 'B2000',
            'C' => 'C3000',
            'D' => 'D4000',
            'E' => 'E5000',
            'F' => 'F6000',
            'G' => 'G7000',
            'H' => 'H8000',
            'I' => 'I9000',
            'J' => 'J1000',
            'K' => 'K1100',
            'L' => 'L1200',
            'M' => 'M1300',
            'N' => 'N1400',
            'O' => 'O1500',
            'P' => 'P1600',
            'Q' => 'Q1700',
            'R' => 'R1800',
            'S' => 'S1900',
            'T' => 'T2000',
            'U' => 'U2100',
            'V' => 'V2200',
            'W' => 'W2300',
            'X' => 'X2400',
            'Y' => 'Y2500',
            'Z' => 'Z2600',
        ];
        foreach (User::all() as $user) {
            $user->update([
                'login_code' => $password2[\strtoupper($user->first_name[0])],
            ]);
        }
    }
}
