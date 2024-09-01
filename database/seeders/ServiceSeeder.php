<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'name' => 'Invoice System',
            'description' => 'Manage invoices, products, and customers.',
            'cover_image' => 'path/to/cover/image.jpg' // Provide a path to a cover image if needed
        ]);
    }
}
