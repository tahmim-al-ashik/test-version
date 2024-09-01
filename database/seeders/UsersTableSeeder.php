<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder

{
    /*** Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '1234567890',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'User',
            'email' => 'user@user.com',
            'phone' => '0987654321',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role' => 'user',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ]);
    }
}

##########seeders->UsersTableSeeder###############
