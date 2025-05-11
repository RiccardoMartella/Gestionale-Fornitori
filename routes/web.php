<?php

use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('suppliers', \App\Http\Controllers\SuppliersController::class);
    Route::resource('breads', \App\Http\Controllers\BreadsController::class);
    Route::resource('deliveries', \App\Http\Controllers\DeliveriesController::class);
    Route::resource('dashboard', \App\Http\Controllers\DashboardController::class);
    Route::resource('points', \App\Http\Controllers\PointController::class);
    Route::resource('returns', \App\Http\Controllers\ReturnDeliveryController::class);
});

require __DIR__ . '/auth.php';
