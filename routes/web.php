<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProposalController;


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

Route::middleware(['auth'])->group(function () {
    Route::resource('invoices', InvoiceController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('proposals', ProposalController::class);
});

require __DIR__.'/auth.php';
