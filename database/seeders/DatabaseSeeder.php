<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'name' => 'admin'
        ]);

        $user = User::create([
            'first_name' => 'psp',
            'last_name' => 'admin',
            'email' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        $user->assignRole('admin');

        Role::create([
            'name' => 'sponsor'
        ]);

        $user = User::create([
            'first_name' => 'convention',
            'last_name' => 'sponsor',
            'email' => 'sponsor',
            'password' => Hash::make('sponsor123'),
        ]);

        $user->assignRole('sponsor');

        Role::create([
            'name' => 'guest'
        ]);

        $this->call(EventAndProgramSeeder::class);
        $this->call(BoothSeeder::class);
        // $this->call(StandeeSeeder::class);
    }
}
