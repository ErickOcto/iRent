<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum', 'admin',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Admin Brand Routing
    Route::resource('brand', App\Http\Controllers\Admin\BrandController::class);

    // Admin Type Routing
    Route::resource('type', App\Http\Controllers\Admin\TypeController::class);

    // Admin Item Routing
    Route::resource('item', App\Http\Controllers\Admin\ItemController::class);

    // Admin Booking Routing
    Route::resource('booking', App\Http\Controllers\Admin\BookingController::class);
});
