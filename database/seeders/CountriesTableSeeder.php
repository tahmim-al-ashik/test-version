<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $countries = ['Bangladesh', 'India', 'Sweden', 'America', 'Other'];

        foreach ($countries as $country) {
            DB::table('countries')->insert(['name' => $country]);
        }
    }
}
