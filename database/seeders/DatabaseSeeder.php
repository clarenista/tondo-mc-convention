<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'first_name' => 'psp',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'role' => '1',
            'password' => Hash::make('admin123'),

        ]);

    }
}
