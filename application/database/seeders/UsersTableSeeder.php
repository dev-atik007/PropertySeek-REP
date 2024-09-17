<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin Data

            [
                'name'      => 'Admin',
                'username'  => 'admin',
                'email'     => 'admin@gmail.com',
                'password'  => Hash::make('admin'),
                'role'      => 'admin',
                'status'    => '1',
            ],

            // Agent data
            [
                'name'      => 'Agent',
                'username'  => 'agent',
                'email'     => 'agent@gmail.com',
                'password'  => Hash::make('agent'),
                'role'      => 'agent',
                'status'    => '1',
            ],

            //user data
            [
                'name'      => 'Robert Fred',
                'username'  => 'user',
                'email'     => 'user@gmail.com',
                'password'  => Hash::make('user'),
                'role'      => 'user',
                'status'    => '1',
            ],
        ]);
    }
}
