<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'first_name' => 'Parth',
            'last_name' => 'KaPatel',
            'phone' => '9924104072',
            'email' => 'parth9427@gmail.com',
            'user_name' => 'user.parth9427',
            'password' => Hash::make('parth123'),
        ]);
        DB::table('customers')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'phone' => '9924104072',
            'email' => 'parthpatel7851@gmail.com',
            'user_name' => 'user.parthpatel7851',
            'password' => Hash::make('admin123'),
            'role'=>'A'
        ]);
    }
}
