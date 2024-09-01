<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'name' => env('APP_NAME', 'Laravel'),

    'env' => env('APP_ENV', 'production'),

    'debug' => (bool) env('APP_DEBUG', false),

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    'timezone' => 'UTC',

    'locale' => 'en',

    'fallback_locale' => 'en',

    'faker_locale' => 'en_US',

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    'maintenance' => [
        'driver' => 'file',
    ],

    'providers' => ServiceProvider::defaultProviders()->merge([
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,
        Barryvdh\DomPDF\ServiceProvider::class,
        // App\Providers\TCPDFServiceProvider::class,
    ])->toArray(),

    'aliases' => Facade::defaultAliases()->merge(items: [
        'Image' => Intervention\Image\Facades\Image::class,
        'QrCode' => SimpleSoftwareIO\QrCode\Facades\QrCode::class,

    ])->toArray(),

];
