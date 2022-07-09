<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        \App\Models\User::create([
            'name' => 'Jay Fructuoso',
            'first_name' => 'Jay',
            'last_name' => 'Fructuoso',
            'email' => 'jay',
            'email_address' => 'jay@wedev.com',
            'classification' => 'wedev',
            'password' => bcrypt('123123'),
        ]);
        \App\Models\User::create([
            'name' => 'Lester Reyes',
            'first_name' => 'Lester',
            'last_name' => 'Reyes',
            'email' => 'lester',
            'email_address' => 'lester@wedev.com',
            'classification' => 'wedev',
            'password' => bcrypt('123123'),
        ]);
        \App\Models\User::create([
            'name' => 'Pedrito Tagayuna',
            'first_name' => 'Pedrito',
            'last_name' => 'Tagayuna',
            'email' => 'bobongmd',
            'email_address' => 'pyt@wedev.com',
            'classification' => 'wedev',
            'password' => bcrypt('123123'),
        ]);
        \App\Models\User::create([
            'name' => 'Mark Joseph Pantaleon',
            'first_name' => 'Mark Joseph',
            'last_name' => 'Pantaleon',
            'email' => 'mj',
            'email_address' => 'mj@wedev.com',
            'classification' => 'wedev',
            'password' => bcrypt('123123'),
        ]);
        \App\Models\User::create([
            'name' => 'Jester Gatdula',
            'first_name' => 'Jester',
            'last_name' => 'Gatdula',
            'email' => 'jester',
            'email_address' => 'jester@wedev.com',
            'classification' => 'wedev',
            'password' => bcrypt('123123'),
        ]);
        \App\Models\User::create([
            'name' => 'Panelist 1',
            'first_name' => 'Panelist',
            'last_name' => '1',
            'email' => 'panel1',
            'email_address' => $faker->email,
            'classification' => 'wedev',
            'password' => bcrypt('123123'),
        ]);
        \App\Models\User::create([
            'name' => 'Panelist 2',
            'first_name' => 'Panelist',
            'last_name' => '2',
            'email' => 'panel2',
            'email_address' => $faker->email,
            'classification' => 'wedev',
            'password' => bcrypt('123123'),
        ]);
        \App\Models\User::create([
            'name' => 'Panelist 3',
            'first_name' => 'Panelist',
            'last_name' => '3',
            'email' => 'panel3',
            'email_address' => $faker->email,
            'classification' => 'wedev',
            'password' => bcrypt('123123'),
        ]);
    }
}
