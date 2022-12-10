<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class admin_data extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_data')->insert([
            [
                'email' => 'admin@gmail.com',
                'username' => 'Admin',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ],
            [
                'email' => 'employee@gmail.com',
                'username' => 'Employee',
                'password' => Hash::make('emp'),
                'role' => 'employee',
            ],
        ]);
    }
}
