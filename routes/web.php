<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StripeWebhookController;


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

//customers 
Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::patch('customers/{customer}/status', [CustomerController::class, 'status'])
        ->name('customers.status');
});

//invoices
Route::middleware(['auth'])->group(function () {
    Route::resource('invoices', InvoiceController::class);
});

//proposals
Route::middleware(['auth'])->group(function () {
    Route::resource('proposals', ProposalController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('invoices', InvoiceController::class);
    Route::post('invoices/{invoice}/send', [InvoiceController::class, 'sendInvoice'])->name('invoices.send');
    Route::get('invoices/{invoice}/success', [InvoiceController::class, 'paymentSuccess'])->name('invoices.success');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('invoices', InvoiceController::class);
    Route::post('invoices/{invoice}/send', [InvoiceController::class, 'sendInvoice'])->name('invoices.send');
    Route::get('invoices/{invoice}/success', [InvoiceController::class, 'paymentSuccess'])->name('invoices.success');
});

//transactions for all and by customer
Route::middleware(['auth'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/customers/{customer}/transactions', [TransactionController::class, 'byCustomer'])->name('customers.transactions');
});

//paymts
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle'])->name('stripe.webhook');


require __DIR__.'/auth.php';
