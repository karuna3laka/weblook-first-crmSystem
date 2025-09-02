<?php

use App\Http\Controllers\CustomerController;
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

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Profile
Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::patch('customers/{customer}/status', [CustomerController::class, 'status'])
        ->name('customers.status');
});

require __DIR__.'/auth.php';
