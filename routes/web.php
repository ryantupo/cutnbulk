<?php

use App\Http\Controllers\DashboardController as DashboardControllerAlias;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\DarkModeController;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/toggle-dark-mode', [DarkModeController::class, 'toggle'])->name('toggle-dark-mode');
});


Route::post('/save-weight-log', [WeightLogController::class, 'save'])->name('save-weight-log');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardControllerAlias::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
