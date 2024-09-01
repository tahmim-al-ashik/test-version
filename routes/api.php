<?php

use App\Http\Controllers\Invoice\InvoiceSettingController;
use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController as ApiAuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\Service\ServiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [ApiAuthController::class, 'apiLogin'])->name('api.login');
Route::post('logout', [ApiAuthController::class, 'apiLogout'])->name('api.logout');

// Protected routes
Route::middleware('auth:api')->group(function () {
    Route::get('services', [ServiceController::class, 'index']);
});

///invoice setting data fetch
//Route::middleware(['auth', 'role:user'])->group(function () {
//    Route::get('/invoice-settings', [InvoiceSettingController::class, 'getInvoiceSettings']);
//});

//Route::middleware('auth:sanctum')->group(function () {
//    Route::get('/customers/search', [CustomerController::class, 'search'])->name('customers.search');
//});

