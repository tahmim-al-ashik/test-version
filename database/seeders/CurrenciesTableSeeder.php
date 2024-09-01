<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CurrenciesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch country IDs for reference
        $countries = [
            'America' => Country::where('name', 'America')->first()->id,
            'Sweden' => Country::where('name', 'Sweden')->first()->id,
            'Bangladesh' => Country::where('name', 'Bangladesh')->first()->id,
            'India' => Country::where('name', 'India')->first()->id
        ];

        $currencies = [
            ['name' => 'USD', 'symbol' => '$', 'country_id' => $countries['America']],
            ['name' => 'EUR', 'symbol' => '€', 'country_id' => $countries['Sweden']], // Assuming Euro for Sweden
            ['name' => 'BDT', 'symbol' => '৳', 'country_id' => $countries['Bangladesh']],
            ['name' => 'INR', 'symbol' => '₹', 'country_id' => $countries['India']]
        ];

        foreach ($currencies as $currency) {
            DB::table('currencies')->insert($currency);
        }
    }
}
